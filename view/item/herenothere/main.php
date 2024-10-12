<?php

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 페이지</title>
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
                                location.href = '/view/item/herenothere/mainPage.php'; // 로그인 성공 시 메인 페이지로 이동
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
        <h1>로그인</h1>
        <input type="hidden" id="type" name="type" value="user/User">
        <input type="hidden" id="route" name="route" value="sign_in">
        <input type="text" class="input-field" id="userId" name="userId" placeholder="이메일 또는 휴대폰 번호">
        <input type="password" class="input-field" id="password" name="password" placeholder="비밀번호">
        <div id="responseMessage"></div>
        <button id="login-btn" class="login-btn">로그인</button>
        <div class="link">
            <a href="#">비밀번호 찾기</a> | <a href="/view/item/herenothere/user/userJoin.php">회원가입</a>
        </div>
    </div>

</body>
</html>