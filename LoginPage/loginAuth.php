<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
  include('../CommonMethods.php');

  session_start();
  $debug = false;
  $COMMON = new Common($debug);

  //set session vars
  $_SESSION['username'] = ($_POST['username']);
  $_SESSION['password'] = (sha1($_POST['password']));

  //get session vars to php
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];

  $sql = "SELECT * FROM `secure_login` WHERE `username` = '$username' AND `password` = '$password'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  $row = mysql_fetch_row($rs);

if($row) {
    $_SESSION['username'] = $row['1']; //username
    $_SESSION['userToken'] = true;

    echo("userToken is $_SESSION['userToken']");
    echo("username: $_SESSION['username']")
    //header('Location: homescreen.php');
  }
else
  {
    $_SESSION['userValue'] = false;

    echo("userToken is $_SESSION['userToken']");
    echo("username: $_SESSION['username']")

    //header('Location: loginStudent.php');
  }

?>
