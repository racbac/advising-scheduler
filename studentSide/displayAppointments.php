<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);


$userMajor;



echo('These are the available appointments with your search terms: \n')<br/>

$sql = "SELECT * FROM `advisors_availability` WHERE `major`=$userMajor";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc  









$lname = $_POST['lname'];
$fname = $_POST['fname'];
$umbc_ID = $_POST['umbc_ID'];
$email = $_POST['email'];
$encrypted_password = md5($_POST['password']);



$sql = "INSERT INTO `students_basic_info` (`id`, `lname`, `fname`, `umbc_ID`, `\
email`, `password`)  VALUES ('', '$lname', '$fname', '$umbc_ID', '$email', '$en\
crypted_password')";

$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);






?>
