<?php
include $_SERVER['DOCUMENT_ROOT']."/application/module/hnh/employee/Employee.php";
$employee = new Employee();
$company_info = $employee->empList($_GET);
$emp_list = $company_info['data']['emp_list'];
$company_nm = $company_info['data']['company_nm'];
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
        <h1 style="color: #F2F2F2;"><?php echo $company_nm; ?></h1>
        <div class="current-time"><?php echo date("Y-m-d H:i:s"); ?></div>
    </header>

    <div class="status-container">
        <?php foreach ($emp_list as $emp) {
            if ($emp['work_status'] == 'HERE') {
        ?>
            <div class="employee-card">
                <div class="employee-name"><?php echo $emp['name'] ?></div>
                <div class="status in">출근 중</div>
                <div class="time"><?php echo $emp['here_time'] ?></div>
            </div>
            <?php } else { ?>
                <div class="employee-card">
                    <div class="employee-name"><?php echo $emp['name'] ?></div>
                    <div class="status out">퇴근</div>
                    <div class="time"><?php echo $emp['here_time'] ?></div>
                </div>
            <?php } ?>
        <?php } ?>

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
