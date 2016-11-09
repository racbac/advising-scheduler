<?php
session_start();
?>

<html>
<head>
<title></title>
</head>
<body>

<?php
$_SESSION['advisorExists'] = false;
$_SESSION['confirmedPass'] = false;
?>

<form action='processLogin.php' method='post' name='AdvisorLogin'>
  <div class='field'>
    <label for='username'>Username</label><br/>
    <input id='username' type='text' size='25' maxlength='50' name='username' required><br/>
  </div>

  <div class='field'>
    <label for='passw'>Password</label><br/>
    <input id='pass' type='password' size='25' maxlength='50' name='pass' required><br/>
  </div>

  <div class='loginButton'>
    <input type='submit' value='Login'>
  </div>
</form>

<form action='advisorInfo.php' method='post' name='CreateAccount'>
  <div class='field'>
    <label for='submit'>Don't have an account set up yet?</label><br/>
    <input type='submit' value='Create New Account'>
  </div>
</form>
</body>
</html>
