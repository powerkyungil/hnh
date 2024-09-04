<?php

$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET') $data = $_GET;
else $data = $_POST;

include_once $_SERVER['DOCUMENT_ROOT']. "/chickendoc/application/module/hnh/".$data['type'].".php";

switch ($data['route']) {
  case 'join':
    $user = new User();
    $result = $user->userJoin($data);
    echo $result['message'];
    break;

  case 'sign_in':
    $user = new User();
    $result = $user->userSignIn($data);
    echo $result['message'];
    break;

}

?>
