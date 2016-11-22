<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<link rel="stylesheet" href="advisor.css" type="text/css">
<?php
session_start();
$debug = false;
include('../../../CommonMethods.php');

$COMMON = new Common($debug);
$_SESSION['confirmedPass'] = false;
$_SESSION['apptExists'] = false;
$user = $_SESSION['username'];
?>


<html>
<head>
<title></title>
<style>
input[type=submit] {
  background-color: #ffcc00;
  border: none;
  color: #000000;
  text-decoration: none;
  margin: 4px 2px;
  text-transform: uppercase;
 }
</style>
</head>
<body>
<h2>Welcome, <?php echo "$user";?></h2>
<form action='processAdvisorHome.php' method='post' name='advisorHome'>
  <input type='submit' name='next' value='Edit Appointments'><br/>
  <input type='submit' name='next' value='View Appointments'><br/>
  <input type='submit' name='next' value='Search Appointments'><br/>
  <input type='submit' name='next' value='Edit Your Account Info'><br/>
  <input type='submit' name='next' value='Logout'><br/>
</form>

</body>
</html>