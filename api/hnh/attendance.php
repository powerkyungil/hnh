<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/application/default.php";

include_once __MODULE_PATH."/attendance/Attendance.php";
$att = new Attendance();

switch ($act) {
  // 출퇴근 체크
  case '/attendance/check':
    chkInvalidMethod($reqMethod, 'POST');
    $result = $att->attendance_check($data);
    break;

  // 출퇴근 정보
  case '/attendance/attendance-info':
    chkInvalidMethod($reqMethod, 'GET');
    $result = $att->monthList($data);
    break;

}

?>