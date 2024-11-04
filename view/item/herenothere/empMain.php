<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/application/module/hnh/employee/Employee.php";
$employee = new Employee();
$emp_info = $employee->empInfo($_GET['userSid']);
$work_status = ($emp_info['work_status'] == 'ON') ? "퇴근" : "출근";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>출퇴근 관리</title>
    <link rel="stylesheet" href="/css/mainPage.css">
    <link rel="stylesheet" href="/css/modal.css">
    <link rel="stylesheet" href="/css/backpage.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<script>
    $(document).ready(function() {
        $("#here").click(function() {
            var work_status = $("#here").val();
            location.href = '/view/item/herenothere/here/here.php?work_status=' + work_status;
        });
    });
</script>
<body>
    <button class="back-button" onclick="history.back()">뒤로가기</button>
    <header>
        <h3><?php echo $emp_info['company_nm'] ?></h3>
        <h1 style="color: #F2F2F2;"><?php echo $emp_info['name'] ?></h1>
        <div class="current-time">마지막 <?php echo $work_status ?>시간 : <?php echo $emp_info['here_time']; ?></div>
    </header>

    <div class="container">
        <div class="here-card">
            <button id="here" class="emp-btn" value="<?php echo $emp_info['work_status']; ?>"><?php echo $work_status ?> 하기</button>
            <button class="emp-btn manage-btn">출퇴근 기록</button>
        </div>
    </div>

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
