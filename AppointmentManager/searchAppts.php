/*phpHeader
 * Project: CMSC331 Project 02, Fall 2016
 * Authors: Felipe Bastos, Rachel Brackert, Travis Earley, Nathaniel Fuller, Colin Ganley
 * Date: 2016-12-16
 * Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
 *
 */

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