<?php
/**
 * 전역 환경 설정
 * 모든 페이지에서 include 되어짐.
 * default 상수/변수 설정
 *
 */

$__main_url__ = $_SERVER["SERVER_NAME"];

// 메인 url
define( "__MAIN_URL",		"http://".$__main_url__ );
// 홈 디렉토리 변수 설정
define( "__MAP_PATH",		$_SERVER["DOCUMENT_ROOT"] );

//시스템 쿼리/에러 메세지 출력
define( "__ECHO_MSG",		1 );

?>