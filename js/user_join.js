// 박스 클릭 시 처리
$('.user-type-box').on('click', function() {
  // 모든 박스에서 'active' 클래스 제거
  $('.user-type-box').removeClass('active');

  // 클릭된 박스에 'active' 클래스 추가
  $(this).addClass('active');

  // 선택된 값을 hidden input에 설정
  $('#user_type').val($(this).data('value'));

  if ($('#user_type').val() == 'ADMIN') {
    $("#company_nm").remove();
    $("#company_code").remove();
    var newInput = $("<input>", {
        id: "company_nm",
        class: "input-field",
        name: "company_nm",
        type: "text",
        placeholder: "회사명을 입력하세요."
    });

    $(".user-type-container").after(newInput);
  } else {
    $("#company_nm").remove();
    $("#company_code").remove();
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

  if (user_type == "" ) {
    $('#responseMessage').text("관리자 또는 직원을 선택해주세요.");
    return;
  } else if (user_type == 'EMPLOYEE') {
    var company_code = $("#company_code").val().trim();
    if (company_code == "") {
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
    if (password != re_password) {
      $('#responseMessage').text('비밀번호가 맞지 않습니다. 디시 확인해 주세요.');
      return;
    }

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
      company_nm: $('#company_nm').val(),
      company_code: $('#company_code').val(),
      name: $('#name').val(),
      post: $('#company_post').val(),
      company_addr1: $('#company_addr1').val(),
      company_addr2: $('#company_addr2').val(),
      company_lat: $('#company_lat').val(),
      company_lon: $('#company_lon').val()
    }

    $.ajax({
        url: '/api/hnh/user/join', // 요청을 보낼 URL
        type: 'POST', // 요청 방식 (POST)
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify(data),
        success: function(response) {
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