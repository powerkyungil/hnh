<?php

class Hnh
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
    print_r($distance);

    return ceil($distance); // 결과를 미터 단위로 반환, 소수점 올림
  }


  function attendanceCheck($company, $location)
  {
    if (empty($company) || empty($location) || $company[0] == "" || $company[1] == "" || $location[0] == "" || $location[1] == "") {
      return apiErrorResponse(400, "위치정보가 없습니다.");
    }

    $distance = $this->getDistance($company[0], $company[1], $location[0], $location[1]);

    // 300m 이내 일 경우 출석처리
    if ($distance <= 300) {
      $message = "Here!";
    } else {
      $message = "Not here!";
    }

    return $message;
  }

}

?>