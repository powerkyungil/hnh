$(document).ready(function() {
    $('#myModal').hide();

    // 모달 열기
    $('.manage-btn').on('click', function() {
        $('#myModal').fadeIn(); // 모달을 페이드 인 효과로 표시
    });

    // 모달 닫기 (X 버튼 클릭 시)
    $('.close').on('click', function() {
        $('#myModal').fadeOut(); // 모달을 페이드 아웃 효과로 숨김
    });

    // 모달 닫기 (취소 버튼 클릭 시)
    $('#cancel-btn').on('click', function() {
        $('#myModal').fadeOut();
    });

    // 확인 버튼 클릭 시 동작
    $('#confirm-btn').on('click', function() {
        alert('작업이 진행되었습니다.'); // 실제 작업에 맞는 동작을 여기에 추가
        $('#myModal').fadeOut(); // 모달을 닫음
    });

    // 모달 밖을 클릭했을 때 모달 닫기
    $(window).on('click', function(event) {
        if ($(event.target).is('#myModal')) {
            $('#myModal').fadeOut();
        }
    });
});
