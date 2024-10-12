<?php
/**
 * API 연동 처리
 * request : 	post 		/api/member/login
 * 						get			/api/employee/myemployees
 * 						get 		/api/employee/myemployees/{sid}   -- path parameter
 * 						get			/api/employee/myemployees?type=정규직/계약지&working=on/off&etc=1  -- query parameter
 * 						detele 	/api/employee/myemployees/delete/{sid}
 * apiBody {String} [firstname]       Optional Firstname of the User.
 * apiBody {String} lastname          Mandatory Lastname.
 * apiBody {String} country="DE"      Mandatory with default value "DE".
 * apiBody {Number} [age=18]          Optional Age with default 18.
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if (!defined('JSON_UNESCAPED_UNICODE'))	define( "JSON_UNESCAPED_UNICODE"	, 256 );
if (!defined('JSON_UNESCAPED_SLASHES'))	define( "JSON_UNESCAPED_SLASHES"	, 64 );

include_once $_SERVER['DOCUMENT_ROOT'] . "/application/function/default_func.php";

// default response
$result = array();
$result['result'] = "SUCCESS";
$result['message'] = "";

// 헤더 정보 조회
$headers = apache_request_headers();

// 컨텐츠 타입이 JSON 인지 확인
if ( !in_array('application/json',explode(';',$_SERVER['CONTENT_TYPE'])) )
{
    $result['result'] = "ERROR";
    http_response_code(400);
    $result['message'] = "Content-type error";

    echo json_encode($result);//, JSON_UNESCAPED_UNICODE); // Forbidden
    exit;
}

// 요청 메서드
$reqMethod = $_SERVER['REQUEST_METHOD'];

//include_once $_SERVER['DOCUMENT_ROOT']."/application/module/util/JWT.php";
//$jwt = new JwtService();

//include_once __MODULE_PATH."/member/user.php";
//$user = new User($jwt);

// PHP 를 사용해 POST/PUT 로 JSON 데이터를 받았을 때 처리
$tmp = file_get_contents("php://input");
$data = json_decode( $tmp, true );

//errorLog( "[".$reqMethod."] " . $_SERVER['REMOTE_ADDR'] . " / " . $_SERVER['REQUEST_URI'] );

// api URI 배열 정보.  /api/member/info/{id} -> array( 'member', 'info', '3' )
$uris = explode( "?", $_SERVER['REQUEST_URI'] );
$acts = explode( "/", str_replace( "/api/hnh/", "", $uris[0] ) );	// /api 제거
// URI에서 쿼리 문자열 추출
// $query = isset($_GET['q']) ? $_GET['q'] : '';
// $acts = explode('/', $query);
$act = "/".$acts[0]."/".$acts[1];

//echoadm( 'act => ' . $act . " / " . json_encode($acts));
//echo 'act = ' . $act . " / querystr = " . $uris[1] . ' / query2 = '. $_SERVER['QUERY_STRING'];
if ( !is_array($acts) || count($acts) == 0 )
{
    $result['result'] = "ERROR";
    http_response_code(400);
    $result['message'] = "Bad Request";

    echo json_encode($result);//, JSON_UNESCAPED_UNICODE); // Forbidden
    exit;
}

/**
 * RequestMethod 체크
 */
function chkInvalidMethod($reqMethod, $expectedMethod)
{
    if ( is_string( $expectedMethod ) && $reqMethod == $expectedMethod ) return;
    else if ( is_array( $expectedMethod ) && in_array($reqMethod, $expectedMethod ) ) return;

    $result = array();
    $result['result'] = "ERROR";
    http_response_code(405);
    $result['message'] = "Method Not Allowed";

    echo json_encode( $result );
    exit;
}

// API 처리 부분 include
include_once $_SERVER['DOCUMENT_ROOT']."/api/hnh/".$acts[0].".php";

// 결과 로그 미생성 항목
// $exclude_logs = ['/calendar/info', '/board/view', '/board/main', '/board/notice', '/board/comment', '/calendar/info', 'document/file', '/document/download', '/education/add', '/education/detail', '/education/update', '/education/download', '/employee/list' ];
// if ( !in_array($act, $exclude_logs) )
// 	errorLog( "json res = " . json_encode( $result ) );

// API 결과 전송
echo json_encode( $result );// , JSON_UNESCAPED_SLASHES );//, JSON_UNESCAPED_UNICODE );//, JSON_UNESCAPED_UNICODE );
?>