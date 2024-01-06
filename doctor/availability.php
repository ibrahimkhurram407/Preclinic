<?php
// availability_picker.php
include(__DIR__ . '/../admin/include/config.php');
session_start();
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
// Check if the doctor_id parameter is set
echo "<a href='./index.php'>Go Back</a><br>";

if (isset($_SESSION['dID'])) {
    $doctorId = $_SESSION['dID'];

    // Handle form submission
    $selectedDays = $_GET['days'];
    $selectedWeeks = $_GET['weeks'];
    $selectedMonths = $_GET['months'];

    // Get the current date
    $currentDate = date('Y-m-d');

    // Get the date of 1st January of next year
    $nextYearDate = date('Y-m-d', strtotime('first day of January next year'));

    // Check the date range and output for debugging
    echo "Current Date: $currentDate<br>";
    echo "End Date: $nextYearDate<br>";
    // Generate an array of dates from the current date to 1st January of next year
    $availableDates = generateDatesArray($currentDate, $nextYearDate, $selectedDays, $selectedWeeks, $selectedMonths);

    // Output the selected days, weeks, months, and available dates for debugging
    echo "Selected Days: " . print_r($selectedDays, true) . "<br>";
    echo "Selected Weeks: " . print_r($selectedWeeks, true) . "<br>";
    echo "Selected Months: " . print_r($selectedMonths, true) . "<br>";
    echo "Available Dates: " . print_r($availableDates, true) . "<br>";
    // Delete entries with id equal to 1
    $deleteQuery = "DELETE FROM availabilitytb WHERE doctor_id = " . $doctorId . ";";
    $deleteResult = mysqli_query($con, $deleteQuery);

    // Check for success or handle errors as needed
    if ($deleteResult) {
        echo "Successfully deleted old entries <br>";
    } else {
        echo "Error deleting entries: " . mysqli_error($con) . "<br>";
    }
    // Insert dates into the database
    foreach ($availableDates as $date) {
        // Check if the date already exists in the table
        $checkQuery = "SELECT COUNT(*) as count FROM availabilitytb WHERE doctor_id = '$doctorId' AND date = '$date'";
        $checkResult = mysqli_query($con, $checkQuery);
    
        if (!$checkResult) {
            echo "Error checking date $date: " . mysqli_error($con) . "<br>";
        } else {
            $row = mysqli_fetch_assoc($checkResult);
            $count = $row['count'];
    
            if ($count == 0) {
                // Date doesn't exist, so proceed with insertion
                $insertQuery = "INSERT INTO availabilitytb (doctor_id, date) VALUES ('$doctorId', '$date')";
                $insertResult = mysqli_query($con, $insertQuery);
    
                if (!$insertResult) {
                    echo "Error inserting date $date: " . mysqli_error($con) . "<br>";
                } else {
                    echo "Successfully inserted date $date<br>";
                }
            } else {
                echo "Date $date already exists in the table<br>";
            }
        }
    }
    ob_end_flush();
    header("location: index.php");
    
    

    
}else{
    echo "no ID in session";
}

// Function to generate an array of dates based on selected days, weeks, and months
function generateDatesArray($startDate, $endDate, $selectedDays, $selectedWeeks, $selectedMonths) {
    $datesArray = [];

    // Loop through each day from the start date to the end date
    for ($currentDate = strtotime($startDate); $currentDate <= strtotime($endDate); $currentDate = strtotime('+1 day', $currentDate)) {
        $currentDay = date('l', $currentDate);
        $currentWeek = ceil(date('d', $currentDate) / 7);
        $currentMonth = date('F', $currentDate);

        // Check if the current day, week, and month are selected
        $dayMatch = empty($selectedDays) || in_array($currentDay, (array)$selectedDays);
        $weekMatch = empty($selectedWeeks) || in_array($currentWeek, (array)$selectedWeeks);
        $monthMatch = empty($selectedMonths) || in_array($currentMonth, (array)$selectedMonths);


        if ($dayMatch or $weekMatch or $monthMatch) {
            $datesArray[] = date('Y-m-d', $currentDate);
        }
    }

    return $datesArray;
}

?>
