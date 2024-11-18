<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 로그인상태일 경우 메인 화면으로 리다이렉트
// if (isset($_SESSION['userSid'])) {
//     if ($_SESSION['user_type'] == 'ADMIN') {
//         header("Location: /view/item/herenothere/adminMain.php?userSid=".$_SESSION['userSid']."&company_code=".$_SESSION['company_code']);
//         exit();
//     } else {
//         header("Location: /view/item/herenothere/empMain.php??userSid=".$_SESSION['userSid']."&company_code=".$_SESSION['company_code']);
//         exit();
//     }
// }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HNH</title>
    <link rel="stylesheet" href="/css/default.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function userJoin() {
            window.location.href = 'view/item/herenothere/user/userJoin.php';
        }

        $(document).ready(function() {
            $('#login-btn').on('click', function(event) {

                event.preventDefault(); // 폼의 기본 제출 동작을 막음 (페이지 이동 방지)

                var data = {
                    type: $('#type').val(),
                    route: $('#route').val(),
                    userId: $('#userId').val(),
                    password: $('#password').val()
                }

                $.ajax({
                    url: '/api/hnh/user/signin', // 요청을 보낼 URL
                    type: 'POST',
                    contentType: 'application/json; charset=utf-8',
                    data: JSON.stringify(data),
                    success: function(response) {
                        console.log(response);
                        try {
                            // data를 사용하는 코드
                            if (response.result === "SUCCESS") {
                                var userSid = response.data.userSid;
                                var companyCode = response.data.company_code;
                                var userType = response.data.user_type;

                                if (userType == 'ADMIN') {
                                    // 로그인 성공 시 관리자 메인 페이지로 이동
                                    location.href = '/view/item/herenothere/adminMain.php?userSid=' + userSid + '&company_code=' + companyCode;
                                } else {
                                    // 로그인 성공 시 직원 메인 페이지로 이동
                                    location.href = '/view/item/herenothere/empMain.php?userSid=' + userSid + '&company_code=' + companyCode;
                                }

                            } else {
                                $('#responseMessage').text(response.message); // 실패 시 에러 메시지 표시
                            }
                        } catch (error) {
                            console.error('JSON 파싱 오류:', error);
                            // 오류 처리 로직
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log('Error HTTP Status:', xhr.status);  // 실패 상태 코드 출력
                        console.log('Error Thrown:', errorThrown);  // 에러 메시지 출력
                        $('#responseMessage').text('오류 발생: ' + xhr.responseText);
                    }
                });
                return false;
            });
        });
    </script>
</head>
<body>

    <div class="login-container">
        <div class="title">
            <h1 class="point-txt" style="color: #BAF266;">H</h1><h1>ere </h1> <h1 class="point-txt" style="color: #BAF266;"> N</h1><h1>ot </h1> <h1 class="point-txt" style="color: #BAF266;"> H</h1><h1>ere</h1>
        </div>
        <input type="hidden" id="type" name="type" value="user/User">
        <input type="hidden" id="route" name="route" value="sign_in">
        <input type="text" class="input-field" id="userId" name="userId" placeholder="이메일 또는 휴대폰 번호">
        <input type="password" class="input-field" id="password" name="password" placeholder="비밀번호">
        <div id="responseMessage" style='color: red; margin-top: 3px;'></div>
        <button id="login-btn" class="login-btn">로그인</button>
        <div class="link">
            <a href="/view/item/herenothere/user/changePassword.php">비밀번호 찾기</a> | <a href="/view/item/herenothere/user/userJoin.php">회원가입</a>
        </div>
    </div>

</body>
</html>