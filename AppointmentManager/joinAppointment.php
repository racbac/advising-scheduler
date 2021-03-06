<!-- name of page -->
<head>
<!--Logout button-->
<div align='right'>
<form action="../LoginPage/processLogout.php" method="post">
<input type="submit" name="logout" value="Log Out">
</div>
</form>

<title>Appointment Join Result</title>
	<!-- Global site tag (gtag.js) - Google Analytics -->
 		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-129353070-1"></script>
 		<script>
 			window.dataLayer = window.dataLayer || [];
 			function gtag(){dataLayer.push(arguments);}
 			gtag('js', new Date());
 			gtag('config', 'UA-129353070-1');
 		</script>
 	</head>


<?php
$debug = false; session_start();
if(!$_SESSION['userToken']) { header('Location: ../LoginPage/login.php'); }
require_once('../CommonMethods.php');
$COMMON = new Common($debug); // common methods

$username = $_SESSION['username'];
$id = $_POST['submit'];

// Get info from userInfo db
$sql = "SELECT * FROM `students_academic_info` WHERE `username` =:username";
$rs = $COMMON->executeQuery($sql, array(':username' => $username), $_SERVER["SCRIPT_NAME"]);
$row = $rs->fetch(PDO::FETCH_NUM);

if ($row['6'] == NULL)
  {
    echo("You have been signed up for this meeting!");

    // Update appointmentID in usersInfo for userName from NULL to $id
    $sql = "UPDATE `students_academic_info` SET `appointmentID`=:apptID WHERE `username`=:username";
    $rs = $COMMON->executeQuery($sql, array(':apptID' => $id, ':username' => $username), $_SERVER["SCRIPT_NAME"]);

    // Increase numStudents in appointments for id = $id
    $sql = "SELECT * FROM `appointments` WHERE `appointment_ID` = :apptID";
    $rs = $COMMON->executeQuery($sql, array(':apptID' => $id), $_SERVER["SCRIPT_NAME"]);
    $row = $rs->fetch(PDO::FETCH_NUM);

    // Inc numStudents by 1
    $newNum = $row['7'];
    $newNum++;

    // Update numStudents in appointments for id from current value to $newNum
     $sql = "UPDATE `appointments` SET `curr_students`='$newNum' WHERE `appointment_ID`=:id";
     $rs = $COMMON->executeQuery($sql, array(':id' => $id), $_SERVER["SCRIPT_NAME"]);
  }
else
  {
    echo("You are already signed up for a meeting.<br>
Please drop your current meeting if you intend to sign up for this one.<br>");
  }
?>
