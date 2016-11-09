<?php
session_start();
var_dump($_POST);
include('../../../CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$date = $_POST['selectedDate'];
$apptTimes = $_POST['apptTimes'];
$numStudents = $_POST['numStudents'];
$locations = $_POST['locations'];
$email = $_SESSION['email'];

if(isset($apptTimes))
  {

    # Query to get the id number of the advisor based on matching email
    $sql = "SELECT `id` FROM `advisor_info` WHERE `email` = '$email'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    $row = mysql_fetch_row($rs);
    echo ("Id number is: " . $row['0'] . "<br/>");
    $id = $row['0'];

    # Query to see if day/advisor is already in database
    $sql = "SELECT * FROM `advisor_appts` WHERE `id` = '$id' AND `date` = '$date'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $appt = mysql_fetch_row($rs);

    if($appt)
      {
	$_SESSION['apptExists'] = true;
	$_SESSION['updateDate'] = $date;
	header('Location: updateAppts.php');
      }

    $timeCols = array('0800', '0830', '0900', '0930', '1000', '1030', '1100', '1130', '1200', '1230', '1300', '1330', '1400', '1430', '1500', '1530', '1600', '1630');
    $query = "INSERT INTO `advisor_appts`(`id`, `date`, `0800`, `0800_loc`, `0830`, `0830_loc`, `0900`, `0900_loc`, `0930`, `0930_loc`, `1000`, `1000_loc`, `1030`, `1030_loc`, `1100`, `1100_loc`, `1130`, `1130_loc`, `1200`, `1200_loc`, `1230`, `1230_loc`, `1300`, `1300_loc`, `1330`, `1330_loc`, `1400`, `1400_loc`, `1430`, `1430_loc`, `1500`, `1500_loc`, `1530`, `1530_loc`, `1600`, `1600_loc`, `1630`, `1630_loc`)" . " VALUES ($id, '$date'";
    $index = 0;
    foreach($timeCols as $timeCol)
      {
	if(in_array($timeCol, $apptTimes))
	  {
	    $max = $numStudents[$index];
	    $loc = $locations[$index];
	  }
	else
	  {
	    $max = 0;
	    $loc = 0;
	  }
	$index++;
	$query .= ", $max, '$loc'";
      }
    
    $query .= ')';
    
    echo $query;
  }

$rsAppt = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
echo("Appointments saved.");
header('Location: advisorHome.php');
?>