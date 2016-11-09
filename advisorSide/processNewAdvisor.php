<?php
session_start();
include('../../../CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$_SESSION['newFirst'] = $_POST['fname'];
$_SESSION['newLast'] = $_POST['lname'];
$_SESSION['newUsername'] = $_POST['username'];
$_SESSION['newPass'] = $_POST['pass'];
$_SESSION['confirmedPass'] = false;
$_SESSION['advisorExists'] = false;
$_SESSION['office'] = $_POST['office'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['majors'] = $_POST['majors'];

$sql = "SELECT * FROM `advisor_info` WHERE `username` = '$_POST[username]' AND `lname` = '$_POST[lname]' AND `fname` = '$_POST[fname]'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if($_POST['pass'] == $_POST['confirmPass'])
  {
    header('Location: createAdvisor.php');
  }
elseif($_POST['pass'] != $_POST['confirmPass'])
  {
    $_SESSION['confirmedPass'] = true;
    header('Location: advisorInfo.php');
  }
elseif($row)
  {
    $_SESSION['advisorExists'] = true;
    header('Location: advisorInfo.php');
  }


?>