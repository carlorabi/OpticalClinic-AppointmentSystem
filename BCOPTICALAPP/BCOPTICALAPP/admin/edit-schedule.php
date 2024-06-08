<?php
// import database
include("../connection.php");

if ($_POST) {
    $oldtitle = $_POST["oldtitle"];
    $title = $_POST['title'];
    $scheduledate = $_POST['scheduledate'];
    $scheduletime = $_POST['scheduletime'];
    $endtime = $_POST['endtime'];
    $id = $_POST['id00'];

    // Check the title length condition
    if (strlen($title) < 5) {
        $error = '3'; // Set error code to indicate a title too short
    } else {
        // Perform the database update
        $sql = "UPDATE schedule SET title='$title', scheduledate='$scheduledate', scheduletime='$scheduletime', endtime='$endtime' WHERE scheduleid=$id";
        $database->query($sql);
        $error = '4';
    }
} else {
    $error = '3';
}

// Redirect with the appropriate error code
header("location: schedule.php?action=edit&error=" . $error . "&id=" . $id);
?>
