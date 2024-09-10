<?php
// 회원
include_once __MODULE_PATH."/user/User.php";
$user = new User();

switch ($act) {
    // 로그인
    case '/user/join':
        chkInvalidMethod($request, 'POST');
        $result = $user->userJoin($data);
        break;

    // 회원가입
    case 'user/signin':
        chkInvalidMethod($request, "POST");
        $result = $user->userSignIn($data);
        break;
}

?>
