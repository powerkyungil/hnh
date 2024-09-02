<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>회원가입</title>
</head>
<script>
    function userJoin() {
        window.location.href = 'user/userJoin.php';
    }
</script>
<body>
  <h1>로그인</h1>
  <form action="route.php" method="post">
    <input type="text" id="userId" placeholder="아이디를 입력하세요.">
    <input type="text" id="password" placeholder="비밀번호를 입력하세요.">
  </form>
  <button type="submit">로그인</button>
  <button type="button" onclick="userJoin()">회원가입하기</button>
</body>
</html>