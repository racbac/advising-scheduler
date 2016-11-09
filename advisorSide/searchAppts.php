<?php
session_start();
$debug = false;
include('../../../CommonMethods.php');

$COMMON = new Common($debug);
?>

<html>
<head>
<title></title>
</head>
<body>

<form action='processSearch.php' method='post' name='searchGroup'>
  <input type='submit' name='next' value='Search by Type'>
</form>
</body>
</html>