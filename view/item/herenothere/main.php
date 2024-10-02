<?php

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 페이지</title>
    <link rel="stylesheet" href="css/default.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function userJoin() {
            window.location.href = 'view/item/herenothere/user/userJoin.php';
        }

        $(document).ready(function() {
            $('#login-btn').on('click', function(event) {
                console.log('test');
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
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    data: JSON.stringify(data),
                    success: function(response) {
                        var data = JSON.parse(response);  // JSON 응답을 파싱

                        if (data.result === "SUCCESS") {
                            //location.replace('main.php'); // 로그인 성공 시 메인 페이지로 이동
                            $('#responseMessage').text(data.message);
                        } else {
                            $('#responseMessage').text(data.message); // 실패 시 에러 메시지 표시
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', error);
                        // 서버 응답이 실패했을 때 처리할 코드
                        $('#responseMessage').text('오류 발생: ' + error);
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
        <button id="login-btn" class="login-btn">로그인</button>
        <div class="link">
            <a href="#">비밀번호 찾기</a> | <a href="view/item/herenothere/user/userJoin.php">회원가입</a>
        </div>
    </div>
    <div id="responseMessage"></div>

</body>
</html>


<!-- <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>회원가입</title>
</head>

<body>
<h1>로그인</h1>
    <input type="hidden" id="type" name="type" value="user/User">
    <input type="hidden" id="route" name="route" value="sign_in">
    <input type="text" id="userId" name="userId" placeholder="아이디를 입력하세요.">
    <input type="text" id="password" name="password" placeholder="비밀번호를 입력하세요.">
<button type='button' id="userSignIn">로그인</button>
<button type="button" onclick="userJoin()">회원가입하기</button>
<div id="responseMessage"></div>
</body>
</html> -->