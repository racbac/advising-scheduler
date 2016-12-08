<!--Logout button-->
<div align='right'>
<form action="../LoginPage/processLogout.php" method="post">
<input type="submit" name="logout" value="Log Out">
</div>
</form>

<?php
session_start();
include ('CommonMethods.php');
$COMMON = new Common(false);

$_SESSION['date'] = $_POST['date'];
$_SESSION['startHour'] = $_POST['startHour'];
$_SESSION['startMin'] = $_POST['startMin'];
$_SESSION['endHour'] = $_POST['endHour'];
$_SESSION['endMin'] = $_POST['endMin'];
$_SESSION['apptSize'] = $_POST['apptSize'];
$_SESSION['sessionLeader'] = $_POST['sessionLeader'];
$_SESSION['location'] = $_POST['location'];
//$_SESSION['majors'] = $_POST['majors'];

//$majorList = $_POST['majors'];

echo("Date: ".$_POST['date']."<br>");
echo("Start Time: ".$_POST['startHour'].":".$_POST['startMin']."<br>");
echo("End Time: ".$_POST['endHour'].":".$_POST['endMin']."<br>");
echo("Appointment Size: ".$_POST['apptSize']."<br>");
echo("Session Leader: ".$_POST['sessionLeader']."<br>");
echo("Location: ".$_POST['location']."<br>");
//echo("Majors allowed:<br>");
//foreach($majorList as $major)
//  {
//    echo($major."<br>");
//  }
?>

<html>
<button onclick="history.go(-1);">Back</button>
<form method="link" action="createAppt.php">
<input type="submit" value="Create Appointment">
</form>
</html>