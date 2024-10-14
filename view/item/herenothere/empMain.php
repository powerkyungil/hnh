<?php
include $_SERVER['DOCUMENT_ROOT']."/application/module/hnh/employee/Employee.php";
$employee = new Employee();
$emp_info = $employee->empInfo($_GET['userSid']);

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
        $("#here").click(function() {
            location.href = '/view/item/herenothere/here/here.php';
        });
    });
</script>
<body>

    <header>
        <h3><?php echo $emp_info['company_nm'] ?></h3>
        <h1 style="color: #F2F2F2;"><?php echo $emp_info['name'] ?></h1>
        <div class="current-time">마지막 출근시간 : <?php echo date("Y-m-d H:i:s"); ?></div>
    </header>

    <div class="container">
        <div class="here-card">
            <button id="here" class="emp-btn">출석 체크</button>
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
