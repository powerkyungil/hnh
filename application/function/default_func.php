<?php

/**
 * API Response
 * code 400으로 올 경우 202로 변경!
 *
 * @param int $code
 * @param string $msg
 * @param string $result
 * @return void
 */
function apiErrorResponse($code, $msg, $err_code = "ERROR") {
  $result = [];

  $code = intval($code);

//  if ( $code == 400 ) $code = 202; // 요청은 접수하였지만, 처리가 완료되지 않았다.

//  http_response_code($code);
  $result['result'] = $err_code;
  $result['message'] = $msg;
  $result['code'] = $code;

  return $result;
}

