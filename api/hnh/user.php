<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/application/default.php";
// 회원
include_once __MODULE_PATH."/user/User.php";
$user = new User();

switch ($act) {
    // 로그인
    case '/user/join':
        chkInvalidMethod($reqMethod, 'POST');
        $result = $user->userJoin($data);
        break;

    // 회원가입
    case '/user/signin':
        chkInvalidMethod($reqMethod, "POST");
        $result = $user->userSignIn($data);
        break;
}

?>
