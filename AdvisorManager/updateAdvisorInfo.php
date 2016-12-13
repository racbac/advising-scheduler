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

if ($_POST['pass'] != $_POST[confimPass]){
  header('Location: editAdvisorInfo.php');
}
$debug = true;
$COMMON = new Common($debug);

$first = $_POST['fname'];
$last = $_POST['lname'];
$user = $_POST['username'];
$pass = $_POST['pass'];
//$_SESSION['confirmedPass'] = false;
//$_SESSION['advisorExists'] = false;
$_SESSION['email'] = $_POST['email'];

//TODO: add colins password encryption

$sql = "UPDATE `users` SET `password` = '$pass', `lastName` = '$last', `firstName` = '$first', `email` = '$email' WHERE `username` = '$user'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

header('Location: advisorHome.php');

?>
