<?php

//include $_SERVER['DOCUMENT_ROOT']. "/hnh/application/function/default_func.php";
include $_SERVER['DOCUMENT_ROOT']. "/hnh/application/core/CoreObject.php";

class User extends CoreObject
{
  function __construct()
  {

  }

  function userJoin($data)
  {
    if ($data['userId'] == "" || $data['password'] == "" || $data['re_password'] == "") {
      return apiErrorResponse(400, "필수 파라미터를 확인해주세요.");
    }

    $query = "select * from user where userId = ?";
    $user_row = $this->connectDb($query, [$data['userId']])->fetchAll(PDO::FETCH_ASSOC);

    if ($user_row) {
      $result['result'] = "FAIL";
      $result['message'] = "이미 존재하는 아이디 입니다.";
    } else {
      $query = "insert into user (userId, password) values (?, ?)";
      $row = $this->connectDb($query, [$data['userId'], $data['password']], 'insert');

      if ($row) {
        $result['result'] = "SUCCESS";
        $result['message'] = "가입성공";
      } else {
        $result['result'] = "FAIL";
        $result['message'] = "가입실패";
      }

    }
    return $result;
  }

  function userSignIn($data)
  {
    if ($data['userId'] == "" || $data['password'] == "") {
      return apiErrorResponse(400, "필수 파라미터를 확인해 주세요.");
    }

    $query = "select * from user where userId = ? and password = ?";
    $user_row = $this->connectDb($query, [$data['userId'], $data['password']])->fetch(PDO::FETCH_ASSOC);

    if ($user_row['sid'] != "") {
      $query = "update user set last_join = ? where sid = ".$user_row['sid'];
      $this->connectDb($query, [date('Y-m-d H:i:s')], 'update');
      $result['result'] = "SUCCESS";
      $result['message'] = "로그인 성공";
      $result['data']['userSid'] = $user_row['sid'];
    } else {
      $result['result'] = "FAIL";
      $result['message'] = "존재하지 않는 아이디 입니다.";
    }
    return $result;
  }
}
?>