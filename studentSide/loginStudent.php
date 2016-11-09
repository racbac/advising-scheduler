<?php
session_start();
?>
<html>
<head>
<title></title>
</head>
<body>

<?php
if($_SESSION['userValue'] == true)
  {
    echo "Invalid username/password combination.";
  }

$_SESSION['confirmedPass'] = false;
$_SESSION['studentExists'] = false;
?>

<form action='processLogin.php' method='post' name='studentLogin'>
  Email: <input type='email' name='email' required><br/><br/>
  Password: <input type='password' name='password' required><br/><br/>
  <input type='submit' value='Login'>
</form>

<form action='registerStudent.php' method='post' name='registerStudent'>
    <input type='submit' value='Register'>
</form>
</body>
</html>
