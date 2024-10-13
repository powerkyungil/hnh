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
<link rel="stylesheet" href="/css/default.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        // 박스 클릭 시 처리
        $('.user-type-box').on('click', function() {
          // 모든 박스에서 'active' 클래스 제거
          $('.user-type-box').removeClass('active');

          // 클릭된 박스에 'active' 클래스 추가
          $(this).addClass('active');

          // 선택된 값을 hidden input에 설정
          $('#user_type').val($(this).data('value'));

          if ($('#user_type').val() == 'admin') {
            console.log('관리자');
            $("#company_code").remove();
          } else {
            console.log('직원');
            var newInput = $("<input>", {
                id: "company_code",
                class: "input-field",
                name: "company_code",
                type: "text",
                placeholder: "회사 코드를 입력하세요."
            });

            $(".user-type-container").after(newInput);
          }
        });

        $(".join_step2").hide();

        $(".next-btn").click(function() {
          event.preventDefault(); // 폼 전송 막기

          var name = $("#name").val();
          var userId = $("#userId").val();
          var password = $("#password").val();
          var re_password = $("#re_password").val();
          var user_type = $("#user_type").val();
          var company_code = $("#company_code").val().trim();

          console.log(user_type);
          if (user_type == "" ) {
            $('#responseMessage').text("가입 유형을 선택해 주세요.");
          } else if (user_type == 'EMPLOYEE') {
            console.log(company_code);
            if (company_code == "") {
              console.log("2222");
              $('#responseMessage').text("회사코드를 입력해 주세요.");
              return;
            }
          }

          if (name == "") {
            $('#responseMessage').text("이름을 입력해 주세요.");
          } else if (userId == "") {
            $('#responseMessage').text("아이디를 입력하세요.");
          } else if (password == "") {
            $('#responseMessage').text("비밀번호를 입력해 주세요.");
          } else if (re_password == "") {
            $('#responseMessage').text("비밀번호를 입력해 주세요.");
          } else {
            $(".join_step1").hide();
            $(".join_step2").show();
          }
        });

        $(".back-btn").click(function() {
          $(".join_step1").show();
          $(".join_step2").hide();
        })

        // 폼 제출 시 선택 여부 확인
        $('#signupForm').on('submit', function(event) {
          if (!$('#user_type').val()) {
            event.preventDefault(); // 폼 전송 막기
            alert('관리자 또는 직원을 선택해주세요.');
          }
        });

        $('#join-btn').click('submit', function(event) {
            event.preventDefault(); // 폼의 기본 제출 동작을 막음 (페이지 이동 방지)

            var data = {
              type: $('#type').val(),
              route: $('#route').val(),
              user_type: $('#user_type').val(),
              userId: $('#userId').val(),
              password: $('#password').val(),
              re_password: $('#re_password').val(),
              company_code: $('#company_code').val(),
              name: $('#name').val()
            }

            $.ajax({
                url: '/api/hnh/user/join', // 요청을 보낼 URL
                type: 'POST', // 요청 방식 (POST)
                contentType: 'application/json; charset=utf-8',
                data: JSON.stringify(data),
                success: function(response) {
                  console.log("test");
                  console.log(response);
                  if (response.result === "SUCCESS") {
                      location.href = '/view/item/herenothere/main.php'; // 로그인 성공 시 로그인 페이지로 이동
                  } else {
                      $('#responseMessage').text(response.message); // 실패 시 에러 메시지 표시
                  }
                },
                error: function(xhr, status, error) {
                  console.log('오류 발생 xhr: ' + xhr);
                  console.log('오류 발생 status: ' + status);
                  console.log('오류 발생 error: ' + error);
                }
            });
        });
    });
</script>

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
        <input type="text" class="input-field" id="addr1" name="addr1" placeholder="주소를 입력해 주세요.">
        <input type="text" class="input-field" id="addr2" name="addr2" placeholder="상세주소를 입력해 주세요.">
        <div id="responseMessage" style="color: red; margin-top: 3px;"></div>
        <div class="between-btn-container">
          <button id="back-btn" class="back-btn between-btn">돌아가기</button>
          <button id="join-btn" class="join-btn between-btn">가입하기</button>
        </div>

      </div>

    </form>
  </div>


</body>
</html>
