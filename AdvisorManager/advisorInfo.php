<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->
<?php

session_start();

//if(!$_SESSION['userToken']) { header('Location: ../error.html'); }

?>

<html>
<head>
<title></title>
</head>
<body>

<form action='processNewAdvisor.php' method='post' name='NewAdvisorProfile'>
  First Name: <input type='text' size='25' maxlength='25' name='fname' required><br/>
  Last Name: <input type='text' size='25' maxlength='25' name='lname' required><br/><br/>
  Username: <input type='text' size='25' maxlength='25' name='username' required><br/>
  Password: <input type='password' size='25' maxlength='50' name='pass' required><br/>
  Confirm Password: <input type='password' size='25' maxlength='50' name='confirmPass' required><br/><br/>
  Office Location: <input type='text' size='25' maxlength='10' name='office' required><br/><br/>
  Email: <input type='email' size='25' maxlength='50' name='email' required><br/><br/>
  <input type='submit' value='Save Profile'>
</form>


</body>
</html>
