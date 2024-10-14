<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<link rel="stylesheet" href="/css/default.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="/js/daum_post.js"></script>

<body>
  <div class="login-container">
    <h1>회원가입</h1>
    <form id="userForm" autocomplete="off">
      <input type="hidden" id="type" name="type" value="user/User">
      <input type="hidden" id="route" name="route" value="join">

      <div class="join_step1">
        <div class="user-type-container">
          <div class="user-type-box" id="adminBox" data-value="ADMIN">관리자</div>
          <div class="user-type-box" id="employeeBox" data-value="EMPLOYEE">직원</div>
        </div>
        <input type="hidden" id="user_type" name="user_type" value="">
        <input type="text" class="input-field" id="name" name="name" placeholder="이름을 입력하세요.">
        <input type="text" class="input-field" id="userId" name="userId" placeholder="아이디를 입력하세요.">
        <input type="password" class="input-field" id="password" name="password" placeholder="비밀번호를 입력하세요.">
        <input type="password" class="input-field" id="re_password" name="re_password" placeholder="다시 한번 비밀번호를 입력하세요.">
        <div id="responseMessage" style="color: red; margin-top: 3px;"></div>
        <button id="next-btn" class="next-btn">다음</button>
      </div>

      <div class="join_step2">
        <div class="between-btn-container">
          <input type="text" class="input-field" id="company_post" name="company_post" placeholder="우편번호">
          <input type="button" class="input-field" onclick="get_address()" value="우편번호 찾기" style="width: 45%; margin-left: 12px; color: #0D0D0D;"><br>
        </div>
        <input type="text" class="input-field" id="company_addr1" name="company_addr1" placeholder="주소를 입력해 주세요.">
        <input type="text" class="input-field" id="company_addr2" name="company_addr2" placeholder="상세주소를 입력해 주세요.">
        <input type="hidden" class="input-field" id="company_lat" name="company_lat" placeholder="경도">
        <input type="hidden" class="input-field" id="company_lon" name="company_lon" placeholder="위도">
        <div id="responseMessage" style="color: red; margin-top: 3px;"></div>
        <div class="between-btn-container">
          <button id="back-btn" class="back-btn between-btn">돌아가기</button>
          <button id="join-btn" class="join-btn between-btn">가입하기</button>
        </div>

      </div>

    </form>
  </div>

  <script src="/js/user_join.js"></script>

</body>
</html>
