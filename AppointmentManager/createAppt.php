<!--Logout button-->
<div align='right'>
<form action="../LoginPage/processLogout.php" method="post">
<input type="submit" name="logout" value="Log Out">
</div>
</form>

<!--Advisor Userpage button-->
<div align='right'>
<form method='link' action='../AdvisorManager/advisorHome.php'>
<input type='submit' value='User Page'>
</div>
</form>

<!--Schedule Viewer button-->
<div align='right'>
<form method='link' action='../ScheduleViewer/scheduleViewer.php'>
<input type='submit' value='Schedule Viewer'>
</div>
</form>

<?php
session_start();
include ('../CommonMethods.php');
$COMMON = new Common(false);

// All variables
$date = $_SESSION['date'];
$startTime = $_SESSION['startHour'].":".$_SESSION['startMin'].":00";
$endTime = $_SESSION['endHour'].":".$_SESSION['endMin'].":00:";
$apptSize = $_SESSION['apptSize'];
$sessionLeader = $_SESSION['sessionLeader'];
$location = $_SESSION['location'];


$sql = "INSERT INTO `appointments`(`advisor_ID`, `date`, `start_time`, `end_time` , `location`, `max_students`, `curr_students`) VALUES ('$sessionLeader','$date','$startTime', '$endTime', '$location', '$apptSize', '0')";
if($rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]) == True)
  {
    echo("Appointment Created!");
  }
else
  {
    echo("Creation Failed.");
  }

?>
