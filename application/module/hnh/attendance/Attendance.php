<?php

include $_SERVER['DOCUMENT_ROOT']. "/application/core/CoreObject.php";

class Attendance extends CoreObject
{
  function __construct()
  {

  }

  /**
   * 두 좌표 거리 ( 단위: m )
   * @param $companyLat
   * @param $companyLon
   * @param $lat
   * @param $lon
   * @param $earthRadius
   * @return float|int
   */
  function getDistance($companyLat, $companyLon, $locationLat, $locationLon, $earthRadius = 6371000)
  {
    // 각도를 라디안으로 변환
    $latFrom = deg2rad($companyLat);
    $lonFrom = deg2rad($companyLon);
    $latTo = deg2rad($locationLat);
    $lonTo = deg2rad($locationLon);

    // Haversine 공식 계산
    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $a = sin($latDelta / 2) * sin($latDelta / 2) +
      cos($latFrom) * cos($latTo) *
      sin($lonDelta / 2) * sin($lonDelta / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // 지구의 반지름 (미터 단위)
    $distance = $earthRadius * $c;

    return ceil($distance); // 결과를 미터 단위로 반환, 소수점 올림
  }


  // 두 좌표사이 거리
  function distanceCheck($company, $location)
  {
    if (empty($company) || empty($location) || $company[0] == "" || $company[1] == "" || $location[0] == "" || $location[1] == "") {
      return apiErrorResponse(400, "위치정보가 없습니다.");
    }

    $distance = $this->getDistance($company[0], $company[1], $location[0], $location[1]);

    // 300m 이내 일 경우 출석처리
    if ($distance <= 300) {
      return "Y";
    } else {
      return "N";
    }
  }

  function monthList($data) {
    if ($data['userSid'] == "" || $data['month'] == "") {
      return apiErrorResponse(400, "필수 파라미터를 확인해주세요.");
    }
    $query= "select * from user where sid = ?";
    $emp_info = $this->select($query, [$data['userSid']])->fetch(PDO::FETCH_ASSOC);

    $query = "select * from attendance_book where userSid = ? and month = ?";
    $attendance_info = $this->select($query, [$data['userSid'], $data['month']])->fetchAll(PDO::FETCH_ASSOC);

    if (empty($attendance_info)) {
      $result['message'] = "출석 이력이 없습니다.";
    } else {
      $result['data']['emp_info'] = $emp_info;
      $result['data']['month_list'] = $attendance_info;
    }

    return $result;
  }

  function attendanceCheck($data) {
    if ($data['type'] == "" || $data['userSid'] == "" || $data['company_code'] == "" || $data['location_lat'] == "" || $data['location_lon'] == "") {
      return apiErrorResponse(400, "필수 파라미터를 확인해주세요.");
    }

    $query = "select company_lat, company_lon from user where company_code = ? and user_type = 'ADMIN' ";
    $company_location = $this->select($query, [$data['company_code']])->fetch(PDO::FETCH_ASSOC);

    $company_location = [$company_info['company_lat'], $company_info['company_lon']];
    $this_location = [$data['location_lat'], $data['location_lon']];

    $check_res = $this->distanceCheck($company_location, $this_location);
    if ($check_res == 'N') return apiErrorResponse(400, "300미터 이내에서만 가능합니다.");

    $this_time = date('His');
    $month = date('Ym');
    $day = date('d');

    if ($data['type'] == 'OFF') {  // 퇴근
      $query = "select * from attendance_book where userSid = ? and month = ? and day = ?";
      $row = $this->select($query, [$data['userSid'], $month, $day])->fetch(PDO::FETCH_ASSOC);

      if (empty($row)) {
        return apiErrorResponse(400, "오늘 출석 정보가 없습니다.");
      } else {
        if ($row['attendance_ed'] != "") return apiErrorResponse(400, "이미 퇴근처리 되었습니다.");

        $updates = ['attendance_ed'=>$this_time];
        $where = ['sid'=>$row['sid']];
        $this->update("attendance_book", $updates, $where);

        $updates = ['work_status'=>'OFF', 'here_time' => date('Y-m-d H:i:s')];
        $where = ['sid'=>$data['userSid']];
        $this->update("user", $updates, $where);
      }
      $result['message'] = "퇴근완료!";

    } else {  // 출근
      $query = "select * from attendance_book where userSid = ? and month = ? and day = ?";
      $row = $this->select($query, [$data['userSid'], $month, $day])->fetch(PDO::FETCH_ASSOC);

      if (!empty($row)) return apiErrorResponse(400, "이미 출근처리 되었습니다.");
      $inserts = [
        'userSid'=>$data['userSid'],
        'month'=>$month,
        'day'=>$day,
        'attendance_st'=>$this_time
      ];
      $this->insert('attendance_book', $inserts);

      $updates = ['work_status'=>'ON', 'here_time' => date('Y-m-d H:i:s')];
      $where = ['sid'=>$data['userSid']];
      $this->update("user", $updates, $where);

      $result['message'] = "출근완료!";
    }

    return $result;
  }
}