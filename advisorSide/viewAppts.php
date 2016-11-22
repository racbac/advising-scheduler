<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
session_start();
$email = $_SESSION['email'];
date_default_timezone_set('EST');
$today = date("Y-m-d");
?>
<html>
<head>
<title></title>
</head>
<body>

<form action='processViewAppts.php' method='post' name='ViewAppts'>
<p><caption><label for='viewDate'> Your Schedule for: </label><input id='viewDate' type='date' name='viewDate' value='<?php echo $today; ?>' min='<?php echo $today; ?>'/></caption></p>
<input type='submit' value='Go'>
</form>

</body>
</html>
