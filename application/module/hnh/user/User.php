<?php

//include $_SERVER['DOCUMENT_ROOT']. "/application/function/default_func.php";
include $_SERVER['DOCUMENT_ROOT']. "/application/core/CoreObject.php";

class User extends CoreObject
{
  function __construct()
  {

  }

  function generateRandomCode() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

  // 회원가입
  function userJoin($data)
  {
    if ($data['userId'] == "" || $data['password'] == "" || $data['user_type'] == "" || $data['name'] == "") {
      return apiErrorResponse(400, "필수 파라미터를 확인해주세요.");
    }

    // 비밀번호 암호화
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

    if($data['user_type'] == 'ADMIN') { // 관리자일 경우
      if ($data['company_nm'] == "") return apiErrorResponse(400, "필수 파라미터를 확인해주세요.");

      $query = "select * from user where userId = ?";
      $user_row = $this->select($query, [$data['userId']])->fetchAll(PDO::FETCH_ASSOC);

      if (!empty($user_row)) {
        $result['result'] = "FAIL";
        $result['message'] = "이미 존재하는 아이디 입니다.";
        return $result;
      }

      // 5글자 회사코드 생성 및 중복체크
      do {
          // 회사코드 생성
          $company_code = $this->generateRandomCode();

          // 중복체크
          $query = "SELECT * FROM user WHERE company_code = ?";
          $user_row = $this->select($query, [$company_code])->fetchAll(PDO::FETCH_ASSOC);
      } while (count($user_row) > 0); // 중복된 코드가 있으면 다시 생성

      $company_nm = $data['company_nm'];

    } else {  // 직원일 경우
      if ($data['company_code'] == "") return apiErrorResponse(400, "필수 파라미터를 확인해주세요.");

      $query = "select * from user where company_code = ? and user_type = 'ADMIN' ";
      $user_row = $this->select($query, [$data['company_code']])->fetch(PDO::FETCH_ASSOC);
      if(empty($user_row)) {
        return apiErrorResponse(400, "존재하지 않는 회사입니다. 회사코드를 확인해 주세요.");
      }
      $company_code = $user_row['company_code'];
      $company_nm = $user_row['company_nm'];
    }

    $inserts = [
      'userId'=>$data['userId'],
      'password'=>$hashedPassword,
      'user_type'=>$data['user_type'],
      'name'=>$data['name'],
      'company_code'=>$company_code,
      'join_type'=>"NORMAL",
      'work_status'=>"NOTHERE",
      'job_status'=>"WORK",
      'company_nm'=>$company_nm,
      'company_addr1'=>$data['company_addr1'],
      'company_addr2'=>$data['company_addr2'],
      'company_lat'=>$data['company_lat'],
      'company_lon'=>$data['company_lon'],
      'reg_dt'=>date("Y-m-d H:i:s")
    ];
    $row = $this->insert("user", $inserts);

    if ($row) {
      $result['result'] = "SUCCESS";
      $result['message'] = "가입성공";
    } else {
      $result['result'] = "FAIL";
      $result['message'] = "가입실패";
    }

    return $result;
  }

  // 로그인
  function userSignIn($data)
  {
    if ($data['userId'] == "" || $data['password'] == "") {
      return apiErrorResponse(400, "아이디와 비밀번호를 확인해 주세요.");
    }

    $query = "select * from user where userId = ?";
    $user_row = $this->select($query, [$data['userId']])->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($data['password'], $user_row['password'])) {
      return apiErrorResponse(400, "비밀번호를 확인해 주세요.");
    }

    if ($user_row && isset($user_row) && $user_row['sid'] != "") {
      $updates = ['last_join'=>date('Y-m-d H:i:s')];
      $where = ['sid'=>$user_row['sid']];
      $this->update("user", $updates, $where);
      $result['result'] = "SUCCESS";
      $result['message'] = "로그인 성공";
      $result['data']['userSid'] = $user_row['sid'];
      $result['data']['company_code'] = $user_row['company_code'];
      $result['data']['user_type'] = $user_row['user_type'];

      $_SESSION['userSid'] = $user_row['sid'];
      $_SESSION['company_code'] = $user_row['company_code'];
      $_SESSION['user_type'] = $user_row['user_type'];
    } else {
      $result['result'] = "FAIL";
      $result['message'] = "존재하지 않는 아이디 입니다.";
    }
    return $result;
  }

  // 비밀번호 변경
  function changePassword($data) {
    if ($data['userId'] == "" || $data['new_password'] == "" || $data['old_password'] == "") {
      return apiErrorResponse(400, "필수 파라미터를 확인해 주세요.");
    }

    $query = "select * from user where userId = ?";
    $user_row = $this->select($query, [$data['userId']])->fetch(PDO::FETCH_ASSOC);

    if (empty($user_row)) {
      return apiErrorResponse(400, "존재하지 않는 아이디 입니다.");
    }

    if (!password_verify($data['old_password'], $user_row['password'])) {
      return apiErrorResponse(400, "비밀번호를 확인해 주세요.");
    } else {
      // 비밀번호 암호화
      $hashedPassword = password_hash($data['new_password'], PASSWORD_DEFAULT);
      $updates = ['password'=>$hashedPassword];
      $where = ['sid'=>$user_row['userSid']];
      $res = $this->update("user", $updates, $where);
      if ($res > 0) {
        $result['result'] = "SUCCESS";
        $result['message'] = "비밀번호 변경이 완료되었습니다.";
      } else {
        $result['result'] = "FAIL";
        $result['message'] = "비밀번호 변경을 실패했습니다.";
      }
    }

    return $result;
  }
}
?>