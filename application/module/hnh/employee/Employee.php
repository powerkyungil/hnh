<?php

include $_SERVER['DOCUMENT_ROOT']. "/application/core/CoreObject.php";

class Employee extends CoreObject
{
  function __construct()
  {

  }

  function empList($data)
  {
    if ($data['userSid'] == "" || $data['company_code'] == "") {
        return apiErrorResponse(400, "필수 파라미터를 확인해주세요.");
    }

    $query = "select company_nm from user where sid = ? and user_type = 'ADMIN' and company_code = ?";
    $admin_info = $this->select($query, [$data['userSid'], $data['company_code']])->fetch(PDO::FETCH_ASSOC);

    if (empty($admin_info)) {
      return apiErrorResponse(400, "관리자 정보가 존재하지 않습니다.");
    } else {
      $result['data']['company_nm'] = $admin_info['company_nm'];
    }

    $query = "select name, work_status, here_time from user where company_code = ? and user_type = 'employee' ";
    $user_list = $this->select($query, [$data['company_code']])->fetchAll(PDO::FETCH_ASSOC);

    if (empty($user_list)) {
      $result['message'] = "직원이 존재하지 않습니다.";
      $result['data']['emp_list'] = [];
    } else {
      $result['data']['emp_list'] = $user_list;
    }

    return $result;
  }
}

?>