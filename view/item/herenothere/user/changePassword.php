<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="/css/default.css">
  <link rel="stylesheet" href="/css/backpage.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <button class="back-button" onclick="history.back()">뒤로가기</button>
  <div class="login-container">
    <h1>비밀번호 변경</h1>
    <form id="userForm" autocomplete="off">
      <input type="hidden" id="type" name="type" value="user/changeps">
      <input type="hidden" id="route" name="route" value="join">

      <input type="text" class="input-field" id="userId" name="userId" placeholder="아이디를 입력하세요.">
        <input type="password" class="input-field" id="old_password" name="old_password" placeholder="기존 비밀번호를 입력하세요.">
        <input type="password" class="input-field" id="new_password" name="new_password" placeholder="새로운 비밀번호를 입력하세요.">
        <input type="password" class="input-field" id="re_password" name="re_password" placeholder="다시 한번 비밀번호를 입력하세요.">
        <div id="responseMessage" style="color: red; margin-top: 3px;"></div>
        <div class="between-btn-container">
          <button id="back-btn" class="back-btn between-btn" onclick="history.back()">돌아가기</button>
          <button id="change-btn" class="join-btn between-btn">변경하기</button>
        </div>
    </form>
  </div>

  <script src="/js/change_password.js"></script>

</body>
</html>
