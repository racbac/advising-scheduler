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


$_SESSION['newLast'] = $_POST['lname'];
$_SESSION['newFirst'] = $_POST['fname'];
$_SESSION['newUmbcID'] = $_POST['umbc_ID'];
$_SESSION['newPass'] = $_POST['password'];
$_SESSION['confirmedPass'] = false;
$_SESSION['studentExists'] = false;
$_SESSION['majors'] = $_POST['majors'];
$_SESSION['email']= $_POST['email'];
$encrypted_password = md5($_POST['password']);

$sql = "SELECT * FROM `students_basic_info` WHERE `lname` = '$_POST[lname]' AND `fname` = '$_POST[fname]' AND `umbc_ID` = '$_POST[umbc_ID]'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if($_POST['password'] == $_POST['confirmPass'])
  {
    header('Location: createStudent.php');
  }
elseif($_POST['password'] != $_POST['confirmPass'])
  {
    $_SESSION['confirmedPass'] = true;
    header('Location: registerStudent.php');
  }
elseif($row)
  {
    $_SESSION['studentExists'] = true;
    header('Location: registerStudent.php');
  }




?>

