<?php
print_r($_POST);
print_r($_GET);
include $_SERVER['DOCUMENT_ROOT']."/application/module/hnh/user/user.php";
$user = new User();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>출퇴근 관리</title>
    <link rel="stylesheet" href="/css/mainPage.css">
</head>
<body>

    <header>
        <h1>주식회사망치꽁</h1>
        <div class="current-time"><?php echo date("Y-m-d H:i:s"); ?></div>
    </header>

    <div class="status-container">
        <div class="employee-card">
            <div class="employee-name">오유진</div>
            <div class="status in">출근 중</div>
            <div class="time">2024-10-06 08:48:10</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">김경일</div>
            <div class="status in">출근 중</div>
            <div class="time">2024-10-06 08:45:22</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">유깽이</div>
            <div class="status out">퇴근</div>
            <div class="time">2024-10-05 18:00:30</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">꽁꽁이</div>
            <div class="status out">퇴근</div>
            <div class="time">2024-10-05 18:01:14</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">런던이</div>
            <div class="status in">출근 중</div>
            <div class="time">2024-10-06 08:48:10</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">쁘니</div>
            <div class="status in">출근 중</div>
            <div class="time">2024-10-06 08:45:22</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">귀요미</div>
            <div class="status out">퇴근</div>
            <div class="time">2024-10-05 18:00:30</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">앵두야</div>
            <div class="status out">퇴근</div>
            <div class="time">2024-10-05 18:01:14</div>
        </div>
        <!-- 직원 목록 추가 가능 -->
    </div>

    <button class="manage-btn">직원 관리</button>

</body>
</html>
