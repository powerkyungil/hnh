<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/application/default.php";

include_once __MODULE_PATH."/employee/Employee.php";
$emp = new Employee();

switch ($act) {
  // 직원목록
  case '/employee/list':
      chkInvalidMethod($reqMethod, 'GET');
      $result = $emp->empList($data);
      break;

}

?>
