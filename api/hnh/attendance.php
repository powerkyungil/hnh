<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/application/default.php";

include_once __MODULE_PATH."/attendance/Attendance.php";
$att = new Attendance();

switch ($act) {
  // 직원목록
  case '/attendance/check':
    chkInvalidMethod($reqMethod, 'POST');
    $result = $att->attendance_check($data);
    break;

}

?>