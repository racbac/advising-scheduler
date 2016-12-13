<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
session_start();
//if(!$_SESSION['userToken']) { header('Location: ../error.html'); }
#var_dump($_POST);
include('../CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$first = $_SESSION['newFirst'];
$last = $_SESSION['newLast'];
$user = $_SESSION['newUsername'];
$pass = $_SESSION['newPass'];
//$encrypted_pass = md5($pass);
$office = $_SESSION['office'];
$email = $_SESSION['email'];
$majors = $_SESSION['majors'];
$_POST['advisorExists'] = false;

# First check to see if advisor already exists, based on querying fname, lname, and username
$sql = "SELECT * FROM `users` WHERE `username` = '$user'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
if($row)
  {
    //$_SESSION['advisorExists'] = true;
    header('Location: advisorInfo.php');
  }
else
  {

/* # Insert username and password into advisor_accounts table */
/* $sql = "INSERT INTO `advisor_accounts`(`id`, `username`, `password`) VALUES ('', '$user', '$encrypted_pass')"; */
/* $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]); */

# First query to insert basic advisor info into the advisor_info table
    $sql = "INSERT INTO `users`(`id`, `firstName`, `lastName`, `username`, `email`, `password`, `userRole`) VALUES ('', '$first', '$last', '$user', '$email'  ,'$pass', 'advisor')";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    echo("Advisor Profile saved.");
    $_SESSION['username'] = $_SESSION['newUsername'];
    header('Location: advisorHome.php');
  }
?>
