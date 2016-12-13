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
  <title> Login </title>
</head>
<body>

<form action='processLogin.php' method='post' name='UserLogin'>
  <div class='field'>
    <label for='username'>Username:</label>
    <input id='username' type='text' name='username' required>
  </div>

  <div class='field'>
    <label for='password'>Password</label>
    <input id='password' type='password' name='password' required>
  </div>

  <div class='loginButton'>
    <input type='submit' value='Login'>
  </div>
</form>

<form action = "createAccount.php" method="get">
   <div class='field'>
      <label for='submit'>Don't have an account set up?</label>
      <input type='submit' value='Register'>
  </div>
</form>

</body>
</html>
