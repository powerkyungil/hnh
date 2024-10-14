<?php
include $_SERVER['DOCUMENT_ROOT']."/application/module/hnh/hnh.php";
$hnh = new Hnh();
$company = [35.992264,128.399989];
$location = [35.9858176,128.401408];
$res = $hnh->attendanceCheck($company, $location);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/default.css">
</head>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=bce2443403585a880b791703016616b5&libraries=clusterer,drawing"></script>
<style>
    #map {
    width: 100%;       /* 부모 요소의 100% 크기로 설정 */
    height: 50vh;      /* 화면 높이의 50% */
    min-height: 300px; /* 최소 높이 설정 */
    border-radius: 4px;
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var container = document.getElementById('map'); // 지도를 담을 영역의 DOM 레퍼런스
        var options = { // 지도를 생성할 때 필요한 기본 옵션
            center: new kakao.maps.LatLng(35.992264,128.399989), // 지도의 중심좌표.
            level: 4 // 지도의 레벨(확대, 축소 정도)
        };

        var map = new kakao.maps.Map(container, options); // 지도 생성 및 객체 리턴

        // 지도 리사이즈 처리 함수
        function resizeMap() {
            map.relayout(); // 지도의 크기가 변경될 때 호출
        }

        // 브라우저 크기 변화 시, 지도의 크기를 재설정
        window.addEventListener('resize', function() {
            resizeMap();  // 리사이즈 이벤트 발생 시 지도 크기 조정
        });

        // 마커가 표시될 회사위치입니다
        var markerPosition  = new kakao.maps.LatLng(35.992264,128.399989);

        // 마커를 생성합니다
        var marker = new kakao.maps.Marker({
            position: markerPosition
        });

        // 마커가 지도 위에 표시되도록 설정합니다
        marker.setMap(map);

        // HTML5의 geolocation으로 사용할 수 있는지 확인합니다
        if (navigator.geolocation) {

            // GeoLocation을 이용해서 접속 위치를 얻어옵니다
            navigator.geolocation.getCurrentPosition(function(position) {

                var lat = position.coords.latitude, // 위도
                    lon = position.coords.longitude; // 경도

                var locPosition = new kakao.maps.LatLng(lat, lon); // 마커가 표시될 위치를 geolocation으로 얻어온 좌표로 생성합니다
                console.log(lat);
                console.log(lon);
                // 마커와 인포윈도우를 표시합니다
                displayMarker(locPosition);

            });

        } else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다

            var locPosition = new kakao.maps.LatLng(33.450701, 126.570667),
                message = 'geolocation을 사용할수 없어요..'

            displayMarker(locPosition, message);
        }

        // 지도에 마커와 인포윈도우를 표시하는 함수입니다
        function displayMarker(locPosition) {

            // 마커를 생성합니다
            var marker = new kakao.maps.Marker({
                map: map,
                position: locPosition
            });

            marker.setMap(map);

            // 지도 중심좌표를 접속위치로 변경합니다
            map.setCenter(locPosition);
        }

        // 출석버튼으로 위치 갱신
        var here_button = document.getElementById("here");
        here_button.addEventListener("click", function () {
            // HTML5의 geolocation으로 사용할 수 있는지 확인합니다
            if (navigator.geolocation) {

                // GeoLocation을 이용해서 접속 위치를 얻어옵니다
                navigator.geolocation.getCurrentPosition(function(position) {

                    var lat = position.coords.latitude, // 위도
                        lon = position.coords.longitude; // 경도

                    var locPosition = new kakao.maps.LatLng(lat, lon); // 마커가 표시될 위치를 geolocation으로 얻어온 좌표로 생성합니다

                    // 마커와 인포윈도우를 표시합니다
                    displayMarker(locPosition);

                    // TODO 현재 위치 정보 전송 및 결과 리턴
                    var clickMsg = document.getElementById("clickMsg");
                    clickMsg.textContent = "경도: " + lat + ", 위도: " + lon;

                });

            } else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다

                var locPosition = new kakao.maps.LatLng(33.450701, 126.570667),
                    message = 'geolocation을 사용할수 없어요..'

                displayMarker(locPosition, message);
            }
        })
    });
</script>

<body>
    <div class="login-container">
        <h1>출석 체크</h1>
        <div id="map"></div>
        <button type="button" id="here" class="join-btn">출석하기</button>
        <div id="clickMsg"></div>
    </div>
</body>
</html>