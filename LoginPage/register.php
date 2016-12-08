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
  <title> Register </title>
</head>
<body>

<form action='processRegister.php' method='post' name='UserRegister'>
  <div class='field'>
    <label for='firstName'>First Name</label>
    <input id='firstName' type='text' name='firstName' required>
  </div>

  <div class='field'>
    <label for='lastName'>Last Name</label>
    <input id='lastName' type='text' name='lastName' required>
  </div>

  <div class='field'>
    <label for='email'>Email</label>
    <input id='email' type='text' name='email' required>
  </div>

  <div class='field'>
    <label for='username'>Username</label>
    <input id='username' type='text' name='username' required>
  </div>

  <div class='field'>
    <label for='password1'>Password</label>
    <input id='password1' type='password' name='password1' required>
  </div>

  <div class='field'>
    <label for='password2'>Repeat Password</label>
    <input id='password2' type='password' name='password2' required>
  </div>

  <label>Role</label>
  <select name="formRole">
    <option value = "student" name='student'>Student</option>
    <option value = "advisor" name='advisor'>Advisor</option>
  </select>

  <div class='registerButton'>
    <input type='submit' value='Register'>
  </div>
</form>
</body>
</html>
