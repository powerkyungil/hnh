<?php

class CoreObject
{
  var $_MODULE_PATH;
  var $config = [];
  var $totalPages = 0;
  private $pdo;

  function __construct()
  {
    // $this->pdo = $this->connectDb();
    // if (!$this->pdo) {
    //     echo "Failed to connect to the database.";
    // }
  }

  function connectDb()
  {
    try {
      $host = 'hnh-mysql.c34img4qg22i.ap-northeast-2.rds.amazonaws.com';    // 서버 호스트명
      $db   = 'hnhdb';  // 데이터베이스 이름
      $user = 'root';         // 데이터베이스 사용자명
      $pass = 'jmsjms43!';             // 데이터베이스 비밀번호 (기본적으로 비어있을 수 있음)
      $charset = 'utf8mb4';   // 문자셋 설정

      $dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // DSN(Data Source Name) 설정

      $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // 에러 모드를 예외로 설정
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // 기본 페치 모드 설정 (연관 배열)
        PDO::ATTR_EMULATE_PREPARES   => false,                  // 쿼리 준비 시 실제 프리페어드 스테이트먼트를 사용
      ];

      return new PDO($dsn, $user, $pass, $options);

    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
      return null;
    }
  }

  function select($query, $params = []) {
    // if (!empty($params)) {
    //   $i = 0; // 파라미터 인덱스를 추적하기 위한 변수
    //   $query = preg_replace_callback('/\?/', function($matches) use (&$i) {
    //     return ":param" . $i++;
    //   }, $query);
    // }

    // $stmt = $this->pdo->prepare($query);

    // foreach ($params as $key => $param) {
    //   $stmt->bindValue(':param'.$key, $param);
    // }

    // $stmt->execute();

    // return $stmt;

    if (!empty($params)) {
      $i = 0; // 파라미터 인덱스를 추적하기 위한 변수
      $query = preg_replace_callback('/\?/', function($matches) use (&$i) {
          return ":param" . $i++;
      }, $query);
    }

    $pdo = $this->connectDb();
    $stmt = $pdo->prepare($query);

    $i = 0;
    foreach ($params as $param) {
        $stmt->bindValue(':param'.$i++, $param);
    }

    $stmt->execute();

    return $stmt;
  }

  function insert($table, $arr) {
    $key_r = array();
    $val_r = array();

    if(!is_array($arr) || count($arr) < 1){
      echo "INSERT 배열값이 잘못되었습니다";
      exit;
    }
    foreach($arr as $key=>$val){
      array_push($key_r,	$key );
      array_push($val_r,	$val );
    }

    $Q = "INSERT INTO ".$table."(".implode(", ", $key_r).") VALUES('".implode("', '", $val_r)."');";

    $pdo = $this->connectDb();
    $stmt = $pdo->prepare($Q);
    $stmt->execute();

    return $stmt->rowCount();
  }

  function update($table, $arr, $where="") {
    $up_r = array();
    $up_w = array();
    if(!is_array($arr) || count($arr) < 1){
      echo "UPDATE 배열값이 잘못되었습니다";
      exit;
    }
    foreach($arr as $key=>$val) {
      array_push($up_r, $key ."= '". $val. "'");
    }
    $Q = "UPDATE ".$table." SET ".implode(", ",$up_r);

    foreach($where as $key=>$val) {
      array_push($up_w, $key ."= '". $val. "'");
    }
    if($where!="") $Q .= " WHERE ".implode(", ",$up_w);

    $pdo = $this->connectDb();
    $stmt = $pdo->prepare($Q);
    $stmt->execute();

    return $stmt->rowCount();
  }

  function delete($table, $where="") {
    $Q = "DELETE FROM ".$table;
    if ($where != "") {
      foreach($where as $key=>$val) {
        array_push($up_w, $key ."=". $val);
      }
      $Q .= " WHERE ".implode(", ",$up_w);
    }

    $stmt = $pdo->prepare($Q);
    $stmt->execute();

    return $stmt->rowCount();
  }

}
?>