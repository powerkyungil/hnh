<?php
// 에러 출력 설정
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include $_SERVER['DOCUMENT_ROOT']. "/application/function/default_func.php";
include $_SERVER['DOCUMENT_ROOT']."/application/module/hnh/user/user.php";
$user = new User();
$data = ['userId'=>"test01", 'password'=>"1234"];
$result = $user->userSignIn($data);
echoadmin(json_encode($result));
print_r($result);

// include $_SERVER['DOCUMENT_ROOT']."/application/core/CoreObject.php";
// $core = new CoreObject();
// $result = $core->connectDb();
// print_r($result);
//$query = "insert into user (userId, password) values (?, ?)";
//$data = ["test02", "1234"];
//$result = $core->connectDb($query, $data);
//print_r($result);

// $arr = [];
// $table = "test";
// $up_r = ['userid'=>'test', 'password'=>"1234"];
// $where = ['userSid'=>'1323'];
// $up_w = [];
// foreach($up_r as $key=>$val) {
//     array_push($arr, $key ."=". $val);
// }
// $Q = "UPDATE ".$table." SET ".implode(", ",$arr);

// foreach($where as $key=>$val) {
//     array_push($up_w, $key ."=". $val);
// }
// if($where!="") $Q .= " WHERE ".implode(", ",$up_w);

// print_r($Q);

?>
