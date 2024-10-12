<?php
print_r($_GET);
print_r($_POST);
$method = $_SERVER['REQUEST_METHOD'];
print_r($method);
if ($method == 'GET') $data = $_GET;
else $data = $_POST;
print_r($data);
include_once $_SERVER['DOCUMENT_ROOT']. "/application/module/hnh/".$data['type'].".php";
print_r("222");
switch ($data['route']) {
  case 'join':
    $user = new User();
    $result = $user->userJoin($data);
    if ($result['result'] == 'SUCCESS') {
      echo "<script>location.href('main.php')</script>";
    }
    break;

  case 'sign_in':
    $user = new User();
    $result = $user->userSignIn($data);

    echo json_encode($result);
    break;
}

?>
