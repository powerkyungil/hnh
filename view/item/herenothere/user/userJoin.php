<?php

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#userForm').on('submit', function(event) {
            event.preventDefault(); // 폼의 기본 제출 동작을 막음 (페이지 이동 방지)

            $.ajax({
                url: '../route.php', // 요청을 보낼 URL
                type: 'POST', // 요청 방식 (POST)
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    // 서버 응답이 성공적일 때 처리할 코드
                    $('#responseMessage').text(response); // 서버의 응답을 표시
                },
                error: function(xhr, status, error) {
                    // 서버 응답이 실패했을 때 처리할 코드
                    $('#responseMessage').text('오류 발생: ' + error);
                }
            });
        });
    });
</script>

<body>
  <h1>회원가입</h1>
  <form id="userForm">
    <input type="hidden" id="type" name="type" value="user/User">
    <input type="hidden" id="route" name="route" value="userJoin">
    <input type="text" id="userId" name="userId" placeholder="아이디를 입력하세요.">
    <input type="text" id="password" name="password" placeholder="비밀번호를 입력하세요.">
    <input type="text" id="re_password" name="re_password" placeholder="확인 비밀번호를 입력하세요.">
    <button type="submit">가입하기</button>
  </form>
  <div id="responseMessage"></div>
</body>
</html>
