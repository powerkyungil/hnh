<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/application/module/hnh/employee/Employee.php";
$employee = new Employee();
$emp_info = $employee->empInfo($_GET['emp_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="/css/default.css">
  <link rel="stylesheet" href="/css/calendar.css">
  <link rel="stylesheet" href="/css/backpage.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
  <button class="back-button" onclick="history.back()">뒤로가기</button>

  <div class="login-container">
    <h1 style="color: #F2F2F2;"><?php echo $emp_info['name'] ?></h1>
    <div class="calendar-header">
        <button id="prev-month">◀</button>
        <h2 id="month-year"></h2>
        <button id="next-month">▶</button>
    </div>
    <table class="calendar">
        <thead>
            <tr>
                <th>일</th>
                <th>월</th>
                <th>화</th>
                <th>수</th>
                <th>목</th>
                <th>금</th>
                <th>토</th>
            </tr>
        </thead>
        <tbody id="calendar-body">
            <!-- 날짜가 여기에 채워집니다 -->
        </tbody>
    </table>
    <div><span class="material-symbols-outlined">check</span>출근 <span style="color: orange">10</span>일 | 지각 <span style="color: orange">7</span>일</div>
    <div><span class="material-symbols-outlined">check</span>오늘 출근 시간 : <?php echo $emp_info['here_time'] ?></div>
</div>
</body>
<script src="/js/calendar.js"></script>
</html>