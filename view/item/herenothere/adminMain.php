<?php
// print_r($_POST);
// print_r($_GET);
// include $_SERVER['DOCUMENT_ROOT']."/application/module/hnh/user/user.php";
// $user = new User();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>출퇴근 관리</title>
    <link rel="stylesheet" href="/css/mainPage.css">
    <link rel="stylesheet" href="/css/modal.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<script>
    $(document).ready(function() {

    });
</script>
<body>

    <header>
        <h1>주식회사 경일버스</h1>
        <div class="current-time"><?php echo date("Y-m-d H:i:s"); ?></div>
    </header>

    <div class="status-container">
        <div class="employee-card">
            <div class="employee-name">직원1</div>
            <div class="status in">출근 중</div>
            <div class="time">2024-10-06 08:48:10</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">직원2</div>
            <div class="status in">출근 중</div>
            <div class="time">2024-10-06 08:45:22</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">직원3</div>
            <div class="status out">퇴근</div>
            <div class="time">2024-10-05 18:00:30</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">직원4</div>
            <div class="status out">퇴근</div>
            <div class="time">2024-10-05 18:01:14</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">직원5</div>
            <div class="status in">출근 중</div>
            <div class="time">2024-10-06 08:48:10</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">직원6</div>
            <div class="status in">출근 중</div>
            <div class="time">2024-10-06 08:45:22</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">직원7</div>
            <div class="status out">퇴근</div>
            <div class="time">2024-10-05 18:00:30</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">직원8</div>
            <div class="status out">퇴근</div>
            <div class="time">2024-10-05 18:01:14</div>
        </div>
        <!-- 직원 목록 추가 가능 -->
    </div>

    <button class="manage-btn">직원 관리</button>

    <!-- 모달 구조 -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>안내</h2>
            <p>추후 추가 예정입니다.</p>
            <button id="cancel-btn">확인</button>
        </div>
    </div>

    <script src="/js/modal.js"></script>

</body>
</html>
