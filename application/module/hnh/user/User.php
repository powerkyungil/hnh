<?php

include $_SERVER['DOCUMENT_ROOT']. "/chickendoc/application/function/default_func.php";
include $_SERVER['DOCUMENT_ROOT']. "/chickendoc/application/core/CoreObject.php";

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

    $query = "select * from user1 where userId = ?";
    $user_row = $this->connectDb($query, [$data['userId']])->fetchAll(PDO::FETCH_ASSOC);

    if ($user_row) {
      $result['result'] = "FAIL";
      $result['message'] = "이미 존재하는 아이디 입니다.";
    } else {
      $query = "insert into user1 (userId, password) values (?, ?)";
      $row = $this->connectDb($query, [$data['userId'], $data['password']])->fetch(PDO::FETCH_ASSOC);

      if ($row) {
        $result['result'] = "SUCCESS";
        $result['message'] = "가입성공";
        $result['data'] = $user_row;
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

    $query = "select * from user1 where userId = ? and password = ?";
    $user_row = $this->connectDb($query, [$data['userId'], $data['password']])->fetchAll(PDO::FETCH_ASSOC);

    if ($user_row) {
      $_SESSION['userSid'] = 1;
      $_SESSION['userId'] = $data['userId'];
      $result['result'] = "SUCCESS";
      $result['message'] = "로그인 성공";
    } else {
      $result['result'] = "FAIL";
      $result['message'] = "존재하지 않는 아이디 입니다.";
    }
    return $result;
  }
}
?>