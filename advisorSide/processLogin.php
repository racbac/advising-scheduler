<?php
session_start();
$debug = false;
include('../../../CommonMethods.php');
$COMMON = new Common($debug);

$_SESSION['username'] = ($_POST['username']);
$_SESSION['pass'] = ($_POST['pass']);
$_SESSION['userValue'] = false;

$user = $_SESSION['username'];
$pass = $_SESSION['pass'];
$encrypted_pass = md5($pass);

/* $sql = "INSERT INTO `advisor_accounts`(`id`, `username`, `password`) VALUES ('', '$user', '$encrypted_pass')"; */
/* $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]); */

$sql = "SELECT * FROM `advisor_info` WHERE `username` = '$user' AND `password` = '$encrypted_pass'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if($row)
  {
    $advisorID = $row['0'];
    $last = $row['3'];
    $first = $row['4'];
    $office = $row['5'];
    $email = $row['6'];
    $_SESSION['advisorID'] = $advisorID;
    $_SESSION['last'] = $last;
    $_SESSION['first'] = $first;
    $_SESSION['office'] = $office;
    $_SESSION['email'] = $email;
    header('Location: advisorHome.php');
  }
else
  {
    $_SESSION['userValue'] = true;
    header('Location: login.php');
  }

?>