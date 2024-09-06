<?php

include $_SERVER['DOCUMENT_ROOT']."/hnh/application/module/hnh/user/User.php";
$user = new User();
$data = ['userId'=>"test01", 'password'=>"1323", 're_password'=>"1323"];
$result = $user->userJoin($data);
print_r($result);

//include $_SERVER['DOCUMENT_ROOT']."/hnh/application/core/CoreObject.php";
//$core = new CoreObject();
//$query = "insert into user1 (userId, password) values (?, ?)";
//$data = ["test02", "1234"];
//$result = $core->connectDb('insert', $query, $data);
?>
