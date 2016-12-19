<!--htmlHeader
Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
session_start();
if(!$_SESSION['userToken']) { header('Location: ../LoginPage/login.php'); }
if($_SESSION['userRole'] != "advisor") {header('Location: ../LoginPage/processLogout.php');}
$debug = false;
include('../CommonMethods.php');

$COMMON = new Common($debug);

$appt = $_POST['id'];
$posts = array($_POST['location'], $_POST['max_students']);
$fields = array("location", "max_students");

//any fields that the advisor wanted to change will be updated to new value
for($x = 0; $x < 2; $x++){
  if (!empty($posts[$x])){
    $sql = "UPDATE `appointments` SET `".$fields[$x]."` = '$posts[$x]' WHERE `appointment_ID` = '$appt'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }
}

//sets the meeting to open or closed if the advisor clicks the appropriate checkbox
if (isSet($_POST['close'])){
  $sql = "SELECT `status` FROM `appointments` WHERE `appointment_ID` = '$appt'";
  $rs = $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  $status = mysql_fetch_row($rs)[0];
  if ($status[0] == 0){
    $sql = "UPDATE `appointments` SET `status` = 1 WHERE `appointment_ID` = '$appt'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }
  else{
    $sql = "UPDATE `appointments` SET `status` = 0 WHERE `appointment_ID` = '$appt'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }
}

//if the advisor checked of a specific students(s) to remove from the appointment, the students
//apppointmentID will be set to NULL and the number of students in the appointment will be deincremented by 1
if (isSet($_POST['students'])){
  foreach($_POST['students'] as $student){
    $sql = "UPDATE `students_academic_info` SET `appointmentID` = NULL WHERE `username`  = '$student'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    
    $sql = "UPDATE `appointments` SET `curr_students` = `curr_students` - 1 WHERE `appointment_ID` = '$appt'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  }

}

header("Location: ../AppointmentManager/allAppointments.php");