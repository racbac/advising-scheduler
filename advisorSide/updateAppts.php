<?php
session_start();
include('../../../CommonMethods.php');
$user = $_SESSION['username'];
$office = $_SESSION['office'];

if($_SESSION['apptExists'] == true)
  {
    echo("You already have set your availability for this day.<br/>");
    echo("If you would like to update your appointments for this day, please make your adjustments and then select 'Update Appointments'.<br/><br/>");

    $_SESSION['apptExists'] == false;
  }

$debug = false;
$COMMON = new Common($debug);

date_default_timezone_set('EST');
$today = date("Y-m-d");
$date = $_SESSION['updateDate'];
$email = $_SESSION['email'];

$sql = "SELECT `id` FROM `advisor_info` WHERE `email` = '$email'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$id = $row['0'];
$advisorID = $_SESSION['advisorID'];
#echo("Advisor ID: ".$advisorID." just id: ".$id."<br/>");

function getApptTimes($id, $date)
{
  global $debug; global $COMMON;
  $times = array('8:00 AM', '8:30 AM', '9:00 AM', '9:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM', '12:00 PM', '12:30 PM', '1:00 PM', '1:30 PM', '2:00 PM', '2:30 PM', '3:00 PM', '3:30 PM', '4:00 PM', '4:30 PM');

  $sql = "SELECT `0800`, `0830`, `0900`, `0930`, `1000`, `1030`, `1100`, `1130`, `1200`, `1230`, `1300`, `1330`, `1400`, `1430`, `1500`, `1530`, `1600`, `1630` FROM `advisor_appts` WHERE `id` = '$id' AND `date` = '$date'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  $sqlLoc = "SELECT `0800_loc`, `0830_loc`, `0900_loc`, `0930_loc`, `1000_loc`, `1030_loc`, `1100_loc`, `1130_loc`, `1200_loc`, `1230_loc`, `1300_loc`, `1330_loc`, `1400_loc`, `1430_loc`, `1500_loc`, `1530_loc`, `1600_loc`, `1630_loc` FROM `advisor_appts` WHERE `id` = '$id' AND `date` = '$date'";
  $rsLoc = $COMMON->executeQuery($sqlLoc, $_SERVER["SCRIPT_NAME"]);
  $rowLoc = mysql_fetch_row($rsLoc);


  # get number of students that signed up for this date this time this advisor
  # compute available openings

  # get student id that signed up for this advisor on this date -- save in array for multiples



  echo("<table border='1px' style='width:35%'>");
  echo("<tr><th>Time</th><th>Type</th><th>Maximum Number of Students</th><th>Location</th></tr>");
  $index = 0;
  while($row = mysql_fetch_row($rs))
    {

      foreach ($row as $element)
	{
	  echo("<tr>");
	  if($element == 0) { $availability = "Not available";}
	  elseif($element == 1) {$availability = "Individual available";}
	  elseif($element >= 1) {$availability = "Group available";}
	  $location = $rowLoc[$index];
	    #if($location == 0) {$location = "";}
	  echo("<td>".$times[$index]."</td>");
	  echo ("<td>".$availability."</td>");
	  echo("<td>".$element."</td>");
	  echo ("<td>".$location."</td>");
	  $index++;
	  echo("</tr>");
	}

    }
  return $row;
}

getApptTimes($id, $date);

?>

<html>
<head>
<title>Edit Appointments</title>
<style>
table, th, td {
border: 1px solid gray;
  border-collapse: collapse;
  font-family:helvetica;
 }

th, td {
padding: 10px;
  text-align: left;
}

tr:nth-child(even) {
  background-color:#eee;
}

tr:nth-child(odd) {
  background-color:#fff;
}

</style>
</head>
<body>
<form action='processViewAppts.php' method='post'>
  <caption><label for='viewDate'>Appointment Date: </label><input id='viewDate' type='date' name='viewDate' value='<?php echo $date; ?>' min='<?php echo $today; ?>'></caption>
  <input type='submit' value='Search'>
  </form>

  <form action='advisorHome.php' method='post'>
  <input type='submit' value='Home'>
  </form>
  </body>
  </html>