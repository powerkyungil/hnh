$(document).ready(function() {
    $(".employee-card").click(function() {
        var empId = $(this).data("emp-id");

        window.location.href = "employee/empInfo.php?emp_id=" + empId;
    });
});