<!--htmlHeader
Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
   session_start();
//if(!$_SESSION['userToken']) { header('Location: ../error.html'); }
$debug = false;
include('../CommonMethods.php');

$COMMON = new Common($debug);
$appt = $_POST['id'];
$sql = "SELECT * FROM `appointments` WHERE `appointment_ID` = '$appt'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$fields = mysql_fetch_assoc($rs);
$location = $fields['location'];
$max_students = $fields['max_students'];

$sql = "SELECT `username` FROM `students_academic_info` WHERE `appointmentID` = '$appt'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$students = mysql_fetch_row($rs);

//TODO: fix for loop, look into whether the array is populating correctly
?>

<html>
<head>
<title></title>
</head>
<body>
Edit Appointment Info <br/>
<form action='processEditAppointments.php' method='post' name='EditMeeting'>
  Location: <input type='text' size='25' maxlength='25' name='location' value=''><br/>
  Max Students: <input type='text' size='25' maxlength='25' name='max_students'><br/><br/>
  Close Registration: <input type='checkbox' name='close' value='yes'><br/>
  <?php 
  //creates a checkbox for every students in the appointment
  if (!empty($students)){
    echo "Remove Specific Students:<br/>";
    foreach($students as $studentid){
      echo "<input type='checkbox' name='students[]' value='".$studentid."'>".$studentid."<br/>";
    }
	  }
?>
  <input type='hidden' name='id' value='<?php echo "$appt"; ?>'>
  <input type='submit' value='Save Profile'>
</form>



