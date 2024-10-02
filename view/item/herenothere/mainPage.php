<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>출퇴근 관리</title>
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #F5F5F5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        header {
            background-color: #0066FF;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .current-time {
            font-size: 16px;
            margin-top: 10px;
        }
        .status-container {
            flex: 1;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .employee-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .employee-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .status {
            font-size: 20px;
            font-weight: bold;
        }
        .status.in {
            color: #4CAF50;
        }
        .status.out {
            color: #F44336;
        }
        .manage-btn {
            background-color: #0066FF;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            margin: 20px;
            cursor: pointer;
        }
        .manage-btn:hover {
            background-color: #0056D2;
        }
    </style>
</head>
<body>

    <header>
        <h1>직원 출퇴근 관리</h1>
        <div class="current-time">2024년 10월 2일, 10:30 AM</div>
    </header>

    <div class="status-container">
        <div class="employee-card">
            <div class="employee-name">홍길동</div>
            <div class="status in">출근 중</div>
        </div>
        <div class="employee-card">
            <div class="employee-name">김철수</div>
            <div class="status out">퇴근</div>
        </div>
        <!-- 직원 목록 추가 가능 -->
    </div>

    <button class="manage-btn">직원 관리 페이지로 이동</button>

</body>
</html>
