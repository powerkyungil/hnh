$(document).ready(function() {
    var today = new Date();
    var currentMonth = today.getMonth();
    var currentYear = today.getFullYear();

    var months = ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"];

    var here = '<span class="material-symbols-outlined" style="color: #BAF266;">humidity_high</span>';
    var nothere = '<span class="material-symbols-outlined">humidity_low</span>';
    var halfhere = '<span class="material-symbols-outlined" style="color: #BAF266;>humidity_mid</span>';
    // 출책/미출책을 랜덤하게 설정하는 함수 (데모용)
    function getAttendanceStatus() {
        return Math.random() > 0.5 ? here : nothere;
    }

    function generateCalendar(month, year) {
        var firstDay = new Date(year, month).getDay();
        var daysInMonth = 32 - new Date(year, month, 32).getDate();

        var calendarBody = $("#calendar-body");
        calendarBody.empty();

        $("#month-year").text(year + " " + months[month]);

        var date = 1;
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
                    var statusDiv = $("<div></div>").html(getAttendanceStatus()).addClass("attendance-status");

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
