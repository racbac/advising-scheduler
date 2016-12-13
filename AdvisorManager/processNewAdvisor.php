<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
session_start();
//if(!$_SESSION['userToken']) { header('Location: ../error.html'); }
include('../CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

if ($_POST['pass'] != $_POST['confirmPass'])
  {
    //add error notification
    header('Location advisorInfo.php');
  }

$_SESSION['newFirst'] = $_POST['fname'];
$_SESSION['newLast'] = $_POST['lname'];
$_SESSION['newUsername'] = $_POST['username'];
$_SESSION['newPass'] = $_POST['pass'];
$_SESSION['confirmedPass'] = false;
$_SESSION['advisorExists'] = false;
$_SESSION['office'] = $_POST['office'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['majors'] = $_POST['majors'];

$sql = "SELECT * FROM `users` WHERE `username` = '$_POST[username]'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
if ($row)
  {
    //add notification
    $_SESSION['username'] = $_POST['username'];
    header('Location advisorHome.php');
  }

header('Location: createAdvisor.php');


?>
