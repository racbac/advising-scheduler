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