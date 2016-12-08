<!---
Project: CMSC331 Project 02, Fall 2016
Authors: Felipe Bastos, Rachel Brackert, Travis Earley, Nathaniel Fuller, Colin Ganley
Date: 2016-12-16
Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu

Students enter new account information using this sticky form. 
---->

<html>
  <head>
    <title>Student Registration - UMBC CMNS Advising</title>
  </head>
  <body>

  <h1>Create an account</h1>
  <form action='registerStudent.php' method='post'>

    First Name: <input type='varchar' size='10' maxlength='40' name='firstName' value="<?php if(isset($_POST['fname'])) echo($_POST['fname']); ?>" required><br/><br/>
    Last Name: <input type='varchar' size='10' maxlength='40' name='lastName' value="<?php if(isset($_POST['lname'])) echo($_POST['lname']); ?>" required><br/><br/>
    Preferred Name: <input type='varchar' size='10' maxlength='40' name='preferredName' value="<?php if(isset($_POST['pname'])) echo($_POST['pname']); ?>" ><br/><br/>
    
    Campus ID: <input type='varchar' size='7' maxlength='7' name='campus_ID' placeholder="Ex: AB12345" value="<?php if(isset($_POST['campus_ID'])) echo($_POST['campus_ID']); ?>" required><br/><br/>
    Email: <input type='email'name='email' size='15' placeholder="Ex: jDoe1@umbc.edu" value="<?php if(isset($_POST['email'])) echo($_POST['email']); ?>" required><br/><br/>
    
    Password: <input type='password' name='password' size='10' maxlength='40' required><br/><br/>
    Re-enter Password: <input type='password' name='confirmPass' size='10' maxlength='40' required><br/><br/> 
    <?php
      if(isset($_POST['submit'])) {
        // verify that passwords match
        if($_POST['confirmPass'] != $_POST['password']) {
          echo("Passwords do not match.<br/>");
          $_POST['errors'] = 1; 
        }

        // verify account doesn't exist
        include("../CommonMethods.php");
        $COMMON = new Common(false);
        $sql = "SELECT * FROM `users` WHERE `campus_ID` = '".$_POST['campus_ID']."'";
        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
        $row = mysql_fetch_row($rs);
        if($row) {
          echo("Account for this UMBC ID already exists.<br/>"); 
          $_POST['errors'] = 1;
        }
      }
      
    ?>

    <input type='submit' name='submit' value='Register'>

  </form>

  </body>
</html>

<?php
  if (isset($_POST['submit']) && !isset($_POST['errors'])) {
    // create the student account
    $sql = "INSERT INTO `users` (`lastName`, `firstName`, `preferredName`, `userRole`, `campus_ID`, `email`, `password`) VALUES ('".$_POST['lastName']."', '".$_POST['firstName']."', '".$_POST['preferredName']."', 'student','".$_POST['campus_ID']."', '".$_POST['email']."', '".md5($_POST['password'])."')";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    // set session and redirect to home
    session_start();
    $_SESSION['campus_ID'] = $_POST['campus_ID'];
    header('Location: studentHome.php');
  }
  
?>
