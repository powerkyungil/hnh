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
      return apiErrorResponse(400, "이미 존재하는 아이디입니다.");
    } else {
      $_SESSION['userSid'] = 1;
      $_SESSION['userId'] = $data['userId'];
    }
    $result['result'] = "SUCCESS";
    $result['message'] = "가입성공";
    $result['data'] = $user_row;

    return $result;
  }
}
?>