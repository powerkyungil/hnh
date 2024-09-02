<?php namespace db;
if (!defined('__BASE_PATH')) exit('No direct script access allowed');

// https://github.com/dcblogdev/pdo-wrapper

use Dcblogdev\PdoWrapper\Database;

//require $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
require __MAP_PATH . "/vendor/autoload.php";

class PdoDb
{
  var $db;

  //생성자
  function __construct($args)
  {
    //$args = array('database'=>$__DB_NAME, 'username'=>$__DB_USER, 'host'=>$__DB_HOST,'password'=>$__DB_PASS);
    $this->db = new Database($args);

    // 추후 제거 mysql strict mode 임시 해제용
    $this->db->run("SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION' ");
  }
}

?>