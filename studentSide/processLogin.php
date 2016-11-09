<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

$_SESSION['umbc_ID'] = ($_POST['umbc_ID']);
$_SESSION['password'] = ($_POST['password']);
$_SESSION['userValue'] = false;

$umbc_ID = $_SESSION['umbc_ID'];
$password = $_SESSION['password'];
$encrypted_pass = md5($password);

$sql = "SELECT * FROM `students_basic_info` WHERE `umbc_ID` = '$umbc_ID' AND `password` = '$encrypted_pass'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if($row)
  {
    $studentID = $row['0'];
    $last = $row['1'];
    $first = $row['2'];
    $umbc_ID = $row['3'];
    $email = $row['4'];
    $_SESSION['studentID'] = $studentID;
    $_SESSION['last'] = $last;
    $_SESSION['first'] = $first;
    $_SESSION['umbc_ID'] = $umbc_ID;
    $_SESSION['email'] = $email;
    header('Location: homescreen.php');
  }
else
  {
    $_SESSION['userValue'] = true;
    header('Location: loginStudent.php');
  }

?>