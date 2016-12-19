<!--htmlHeader
Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
session_start();
if(!$_SESSION['userToken']) { header('Location: ../LoginPage/login.php'); }
$debug = false;
include('../CommonMethods.php');

$COMMON = new Common($debug);

$extraInfo = $_POST['extra'];
$appt = $_POST['id'];

//get the date and time info from the appointment database
$sql = "SELECT * FROM `appointments` WHERE `appointment_ID` = '$appt'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$info = mysql_fetch_assoc($rs);
$date = $info['date'];
$start = $info['start_time'];

//ensures the html headers and other similar things dont show up in the csv file
ob_end_clean();
ob_start();

//creates csv file which will be downloaded
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="meeting.csv";');
$file = fopen('php://output', 'w');

//sets the title cells
$titles = array("Date", "Time", "Campus ID", "First", "Last", "Major");
if (isset($extraInfo)){
  array_push($titles, "Career Goal(s)", "Questions and Concerns");
}
fputcsv($file, $titles);

//gets all of the students who are in that appointment
$sql = "SELECT * FROM `students_academic_info` WHERE `appointmentID` = '$appt'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$students = array();
$index = 0;
while($current = mysql_fetch_assoc($rs)){
  $students[$index] = $current;
  $index++;
}

//loops through the list of students and creates an array, then inputs that into the file
foreach($students as $student){
  $username = $student['username'];
  $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  $names = mysql_fetch_row($rs);
  $array = array($date, $start, $student['campusID'], $names[0], $names[1], $student['major']);
  
  //adds the extra info fields into the spreadsheet if asked for by advisor
  if (isset($extraInfo)){	   
    $sql = "SELECT `futurePlans`, `advisingQuestions` FROM `students_academic_info` WHERE `username` = '$username'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $extra = mysql_fetch_array($rs);
    if($extra[0] != NULL){
      array_push($array, $extra[0]);
    }
    else {
      $blank = "";
      array_push($array, "");
    }
    if($extra[1] != NULL){
      array_push($array, $extra[1]);
    }
  }
  fputcsv($file, $array);
}

