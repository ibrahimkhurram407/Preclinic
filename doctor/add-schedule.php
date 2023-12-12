<?php 
    require_once "include/header.php";
    require_once "include/sidebar.php";
    if (!isset($_SESSION['dname'])) {
        header("location: ./login.php");
        die("You are not authorised");
    }
    
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Schedule</h4>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-8 offset-lg-2">
    <form method="post" action="" id="availabilityForm">
        <div class="form-group">
            <label for="days">Select Days:</label>
            <select name="days" multiple class="form-control">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
        </div>

        <div class="form-group">
            <label for="weeks">Select Weeks:</label>
            <select name="weeks" multiple class="form-control">
                <option value="1">Week 1</option>
                <option value="2">Week 2</option>
                <option value="3">Week 3</option>
                <option value="4">Week 4</option>
            </select>
        </div>

        <div class="form-group">
            <label for="months">Select Months:</label>
            <select name="months" multiple class="form-control">
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Set Availability</button>
    </form>

    <script>
        // Add event listener to dynamically update the form action URL
        document.getElementById('availabilityForm').addEventListener('submit', function (event) {
            event.preventDefault();

            // Get selected options
            var selectedDays = Array.from(this.elements['days'].options)
                .filter(option => option.selected)
                .map(option => option.value);

            var selectedWeeks = Array.from(this.elements['weeks'].options)
                .filter(option => option.selected)
                .map(option => option.value);

            var selectedMonths = Array.from(this.elements['months'].options)
                .filter(option => option.selected)
                .map(option => option.value);

            // Update the form action URL
            this.action = 'availability.php?days=' + selectedDays.join(',') +
                '&weeks=' + selectedWeeks.join(',') +
                '&months=' + selectedMonths.join(',');

            // Submit the form
            this.submit();
        });
    </script>
</div>

        </div>
    </div>
</div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
<script>
$(function() {
    $('#datetimepicker3').datetimepicker({
        format: 'LT'
    });
    $('#datetimepicker4').datetimepicker({
        format: 'LT'
    });
});
</script>
<script>
var Active = document.getElementById('add-schedule');
Active.classList.add('active');
</script>
</body>


<!-- add-schedule24:07-->

</html>