$(document).ready(function() {
    var today = new Date();
    var currentMonth = today.getMonth();
    var currentYear = today.getFullYear();

    var months = ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"];

    var on = '<span class="material-symbols-outlined" style="color: #BAF266;">humidity_high</span>';
    var off = '<span class="material-symbols-outlined">humidity_low</span>';
    var halfhere = '<span class="material-symbols-outlined" style="color: #BAF266;>humidity_mid</span>';
    // 출책/미출책을 랜덤하게 설정하는 함수 (데모용)
    function getAttendanceStatus() {
        return Math.random() > 0.5 ? on : off;
    }

    // function generateCalendar(month, year) {
    //     var firstDay = new Date(year, month).getDay();
    //     var daysInMonth = 32 - new Date(year, month, 32).getDate();

    //     var calendarBody = $("#calendar-body");
    //     calendarBody.empty();

    //     $("#month-year").text(year + " " + months[month]);

    //     var date = 1;
    //     for (var i = 0; i < 6; i++) {
    //         var row = $("<tr></tr>");

    //         for (var j = 0; j < 7; j++) {
    //             if (i === 0 && j < firstDay) {
    //                 row.append($("<td></td>"));
    //             } else if (date > daysInMonth) {
    //                 break;
    //             } else {
    //                 var cell = $("<td></td>");
    //                 var dateDiv = $("<div></div>").text(date);
    //                 var statusDiv = $("<div></div>").addClass("status"+date);

    //                 cell.append(dateDiv).append(statusDiv);

    //                 if (date === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
    //                     cell.addClass("current-day");
    //                 }
    //                 row.append(cell);
    //                 date++;
    //             }
    //         }

    //         calendarBody.append(row);
    //     }
    // }

    function generateCalendar(month, year) {
        var firstDay = new Date(year, month).getDay();
        var daysInMonth = 32 - new Date(year, month, 32).getDate();
        var calendarBody = $("#calendar-body");
        var empId = $("#empId").val();
        var date_month = $("#month").val();

        calendarBody.empty();
        $("#month-year").text(year + " " + months[month]);

        // 현재 날짜 가져오기
        var today = new Date();
        var date = 1;

        // 상태 데이터를 AJAX로 가져오기
        $.ajax({
            url: "/api/hnh/attendance/attendance-info", // 상태값을 반환하는 PHP 파일 경로
            type: "GET",
            data: { userSid: empId, month: date_month}, // 필요 시 사원 ID 전달
            success: function(statusData) {
                for (var i = 0; i < 6; i++) {
                    var row = $("<tr></tr>");

                    for (var j = 0; j < 7; j++) {
                        if (i === 0 && j < firstDay) {
                            row.append($("<td></td>"));
                        } else if (date > daysInMonth) {
                            break;
                        } else {
                            var cell = $("<td></td>");
                            var dateDiv = $("<div></div>").text(date);

                            // 상태 div 생성
                            var statusDiv = $("<div></div>").html(off).addClass("status" + date).addClass("attendance-status");

                            for (let i=0; i<statusData.data.month_list.length; i++) {
                                var day = statusData.data.month_list[i].day;
                                $(".status"+day).html(on);
                            }

                            cell.append(dateDiv).append(statusDiv);

                            if (date === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                                cell.addClass("current-day");
                            }
                            row.append(cell);
                            date++;
                        }
                    }
                    calendarBody.append(row);
                }
            },
            error: function() {
                console.error("상태 데이터를 가져오는 데 실패했습니다.");
            }
        });
    }


    $("#prev-month").click(function() {
        currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        generateCalendar(currentMonth, currentYear);
    });

    $("#next-month").click(function() {
        currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
        generateCalendar(currentMonth, currentYear);
    });

    generateCalendar(currentMonth, currentYear);
});
