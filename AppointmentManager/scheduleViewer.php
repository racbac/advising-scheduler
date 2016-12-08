

<?php
  // give option to search for specific meetings?

session_start();
// Common methods
include('CommonMethods.php');
$COMMON = new Common(false);

// Get current user name and check if advisor
//$userName = $_SESSION['userName'];
//$isAdvisor = $_SESSION['isAdvisor'];
$username = 'fullern1';
$isAdvisor = 'student';

$fieldOfStudy;

// if it's a student get their field of study
if($isAdvisor == 'student')
  {
    $sql = "SELECT * FROM `students_academic_info` WHERE `username` ='$username'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs);
    $fieldOfStudy = $row['3'];
  }

// Get all appointment data
$sql = "SELECT * FROM `appointments`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

// box for meetings to be in, i to keep count of number of boxes
echo("<tr>");
$i = 0;

// if advisor display all appointments + give options to edit
if($isAdvisor == 'advisor')
  {
    // display buttons for advisor to return to user page/create appt
    // code goes here
  }
else
  {
    // display buttons for student to return to user page
    // code goes here

    while($row = mysql_fetch_row($rs))
      {
	// Only display appts happening more than 24 hours from now??
	// code goes here??
	// Only show meeting if space is available and for students major
	if(($row['7']<$row['5']) and (strpos($row['6'],$fieldOfStudy)) !== false)
	  {
	    
	  }
      }
  }
// end box
echo("</tr>");

// set default timezone
date_default_timezone_set("EST");
// curent time in hours, minutes, seconds
$currentTime = date('h-i-s');
// current time in year, month, day
$tomorrow = date('Y-m-d');
echo("$currentTime<br>");
echo("$tomorrow");
?>

