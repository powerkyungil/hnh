$('#back-btn').click(function(event) {
  location.href = '/view/item/herenothere/main.php'; // 로그인 성공 시 로그인 페이지로 이동
});

$('#change-btn').click('submit', function(event) {
  event.preventDefault(); // 폼의 기본 제출 동작을 막음 (페이지 이동 방지)

  var userId = $('#userId').val();
  var old_password = $('#old_password').val();
  var new_password = $('#new_password').val();
  var re_password = $('#re_password').val();

  if (userId == "") {
    $('#responseMessage').text("아이디를 입력하세요.");
    return;
  } else if (old_password == "") {
    $('#responseMessage').text("기존 비밀번호를 입력해 주세요.");
    return;
  } else if (new_password == "") {
    $('#responseMessage').text("새로운 비밀번호를 입력해 주세요.");
    return;
  } else if (re_password == "") {
    $('#responseMessage').text("다시 한번 비밀번호를 입력해 주세요.");
    return;
  } else {
    if (old_password == new_password) {
      $('#responseMessage').text('기존 비밀번호와 다른 비밀번호로 설정해 주세요.');
      return;
    }

    if (new_password != re_password) {
      $('#responseMessage').text('비밀번호가 다릅니다. 다시 한번 확인해 주세요.');
      return;
    }
  }

  var data = {
    userId: userId,
    old_password: old_password,
    new_password: new_password
  }

  $.ajax({
      url: '/api/hnh/user/changeps', // 요청을 보낼 URL
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