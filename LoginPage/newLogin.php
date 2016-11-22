<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
session_start();
?>

<html>
<head>
<title></title>
</head>
<body>

<?php
$_SESSION['studentExists'] = false;
$_SESSION['confirmedPass'] = false;
?>

<form action='processLogin.php' method='post' name='studentLogin'>
  <div class='field'>
    <label for='email'>Email</label><br/>
    <input type='email' name='email' required><br/><br/>
  </div>

  <div class='field'>
    <label for='password'>Password</label><br/>
    <input type='password' name='password' required><br/><br/>
  </div>

  <div class='loginButton'>
    <input type='submit' value='Login'>
  </div>
</form>

<form action='registerStudent.php' method='post' name='registerStudent'>
  <input type='submit' value='Register'>
</form>
</body>
</html>
