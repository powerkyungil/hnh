<?php

class CoreObject
{
  var $_MODULE_PATH;
  var $config = [];
  var $totalPages = 0;

  function __construct()
  {
  }

  function connectDb($query, $params = [])
  {
    $host = 'localhost';    // 서버 호스트명
    $db   = 'hnh';  // 데이터베이스 이름
    $user = 'root';         // 데이터베이스 사용자명
    $pass = '1323';             // 데이터베이스 비밀번호 (기본적으로 비어있을 수 있음)
    $charset = 'utf8mb4';   // 문자셋 설정

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // DSN(Data Source Name) 설정

    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // 에러 모드를 예외로 설정
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // 기본 페치 모드 설정 (연관 배열)
      PDO::ATTR_EMULATE_PREPARES   => false,                  // 쿼리 준비 시 실제 프리페어드 스테이트먼트를 사용
    ];

    try {
      $pdo = new PDO($dsn, $user, $pass, $options);

      if (!empty($params)) {
        $i = 0; // 파라미터 인덱스를 추적하기 위한 변수
        $query = preg_replace_callback('/\?/', function($matches) use (&$i) {
          return ":param" . $i++;
        }, $query);
      }

      $stmt = $pdo->prepare($query);
      foreach ($params as $key => $param) {
        $stmt->bindParam(':param'.$key, $param);
      }
      $stmt->execute();

      return $stmt;

    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
    }
  }

}
?>