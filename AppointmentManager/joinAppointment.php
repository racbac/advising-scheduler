<!-- name of page -->
<head>
<!--Logout button-->
<div align='right'>
<form action="../LoginPage/processLogout.php" method="post">
<input type="submit" name="logout" value="Log Out">
</div>
</form>

<title>Appointment Join Result</title>
</head>


<?php
$debug = false; session_start();
if(!$_SESSION['userToken']) { header('Location: ../LoginPage/login.php'); }
include('../CommonMethods.php');
$COMMON = new Common($debug); // common methods

$username = $_SESSION['username'];
$id = $_POST['submit'];

// Get info from userInfo db
$sql = "SELECT * FROM `students_academic_info` WHERE `username` ='$username'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if ($row['6'] == NULL)
  {
    echo("You have been signed up for this meeting!");

    // Update appointmentID in usersInfo for userName from NULL to $id
    $sql = "UPDATE `students_academic_info` SET `appointmentID`='$id' WHERE `username`='$username'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    // Increase numStudents in appointments for id = $id
    $sql = "SELECT * FROM `appointments` WHERE `appointment_ID` = $id";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs);

    // Inc numStudents by 1
    $newNum = $row['7'];
    $newNum++;

    // Update numStudents in appointments for id from current value to $newNum
     $sql = "UPDATE `appointments` SET `curr_students`='$newNum' WHERE `appointment_ID`='$id'";
     $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }
else
  {
    echo("You are already signed up for a meeting.<br>
Please drop your current meeting if you intend to sign up for this one.<br>");
  }
?>
