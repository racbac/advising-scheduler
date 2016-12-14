<!--
Project: CMSC331 Project 02, Fall 2016
Authors: Felipe Bastos, Rachel Backert, Travis Earley, Nathaniel Fuller, Colin Ganley
Date: 2016-12-16
Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu

Users enter new account information using this sticky form. 
-->

<html>
  <head>
    <title>Account Creation - UMBC CMNS Advising</title>
    <style>
        #preferred_name, #campusID, #major {
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            transition: all 0.5s ease;
            max-height: 50px;
            overflow: hidden;
        }
        #advisor_rb:checked~.studentField   {
            max-height: 0px;
            opacity: 0;
            pointer-events: none;      
        }

    </style>
  </head>
  <body>

    <h1>Create an account</h1>   
    <form action='createAccount.php' method='post'>
        <label><input type="radio" name="userRole" value="student" checked> Student </label>
        <input type="radio" name="userRole" id="advisor_rb" value="advisor"><label for="advisor_rb">Advisor</label>
        
        <div> First Name: <input type='varchar' size='10' maxlength='40' name='firstName' <?php sticky("firstName"); ?> required></div>

        <div> Last Name: <input type='varchar' size='10' maxlength='40' name='lastName' <?php sticky("lastName"); ?> required></div>
        
        <div> Email: <input type='email'name='email' size='15' pattern=".*@umbc.edu" title="UMBC email address jDoe@umbc.edu" placeholder="Ex: jDoe1@umbc.edu" <?php sticky("email") ?> required></div>

        <div> Password: <input type='password' name='password' size='10' maxlength='40' required></div>

        <div> Re-enter Password: <input type='password' name='confirmPass' size='10' maxlength='40' required></div>  

        <div class="studentField">Major next semester: 
            <select name="major" >
                <option disabled value <?php stickySelect("major", "", "");  ?> ></option>
                <option value="Biological Sciences B.A." <?php stickySelect("major", "Biological Sciences B.A.", ""); ?> >Biological Sciences B.A.</option>
                <option value="Biological Sciences B.S." <?php stickySelect("major", "Biological Sciences B.S.", ""); ?> >Biological Sciences B.S.</option>
                <option value="Biochemistry & Molecular Biology B.S." <?php stickySelect("major", "Biochemistry & Molecular Biology B.S.", ""); ?> >Biochemistry & Molecular Biology B.S.</option>
                <option value="Bioinformatics & Computational Biology B.S." <?php stickySelect("major", "Bioinformatics & Computational Biology B.S.", ""); ?> >Bioinformatics & Computational Biology B.S.</option>
                <option value="Biology Education B.A." <?php stickySelect("major", "Biology Education B.A.", ""); ?> >Biology Education B.A.</option>
                <option value="Chemistry B.A." <?php stickySelect("major", "Chemistry B.A.", ""); ?> >Chemistry B.A.</option>
                <option value="Chemistry B.S." <?php stickySelect("major", "Chemistry B.S.", ""); ?> >Chemistry B.S.</option>
                <option value="Chemistry Education B.A." <?php stickySelect("major", "Chemistry Education B.A.", ""); ?> >Chemistry Education B.A.</option>
                <option value="Other" <?php stickySelect("major", "Other", ""); ?> >Other</option>
            </select>
        </div>

        <div class="studentField" > Campus ID: <input type="text" size="7" maxlength='7' name='campusID' placeholder="Ex: AB12345" title="UMBC campus id AB12345" pattern="[a-zA-Z][a-zA-Z][0-9]{5}" <?php sticky("campusID") ?> ></div>

        <div class="studentField" > Preferred Name: <input type="text" size="10" maxlength="40" name='preferredName' <?php sticky("preferredName") ?> ></div>

        <input type='submit' name='submit' value='Register'>
    </form>
  </body>
</html>

<?php
    if(isset($_POST['submit'])) {
        // verify that passwords match
        $errors = 0;
        if($_POST['confirmPass'] != $_POST['password']) {
            echo("Passwords do not match.<br/>");
            $errors++; 
        }

        // verify account doesn't exist
        include("../CommonMethods.php");
        $COMMON = new Common(false);

        $username = substr($_POST['email'], 0, strpos($_POST['email'], "@"));
        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
        $row = mysql_fetch_row($rs);
        if($row) {
            echo("Account for this UMBC ID already exists.<br/>"); 
            $errors++;
        }

        // make students are CMNS majors
        if ($_POST['userRole'] == "student") {
            if (isset($_POST['major']))  {
                if ($_POST['major'] == "Other") {
                    echo("You have indicated that you plan to pursue a major other than one of the following, beginning next semester: Biological Sciences B.A., Biological Sciences B.S., Biochemistry & Molecular Biology B.S., Bioinformatics & Computational Biology B.S., Biology Education B.A., Chemistry B.A., Chemistry B.S., or Chemistry Education B.A.. In order to obtain the BEST advice about course selection, degree progress, and academic policy, please meet with a representative of the department that administers your NEW major.</br>
                    You can find advising contact information for your new major on the Office for Academic and Pre-Professional Advising Office’s Departmental Advising page. That contact person/office will be able to give you instructions on how to schedule an advising appointment with someone in that area. </br>
                    Good luck with your new major!");
                    exit();
                }
            }  else {
                $errors++;
                echo("Please choose a major. ");
            }
            
            // make sure students gave campus id
            if ($_POST['campusID'] == "") {
                $errors++;
                echo("Please enter your campus ID. ");
            }
        }
        
    
        // if no errors, create new account
        if ($errors == 0) {
            
            $sql = "INSERT INTO `users` (`lastName`, `firstName`, `username`, `userRole`, `email`, `password`) VALUES ('".$_POST['lastName']."', '".$_POST['firstName']."', '".$username."', '".$_POST['userRole']."', '".$_POST['email']."', '".sha1($_POST['password'])."')";
            $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
            
            // set user in session and redirect to appropriate user homepage
            session_start();
            $_SESSION['username'] = $username;
            if ($_POST['userRole'] == "student") {
                // extra student information
                $sql = "INSERT INTO `students_academic_info` (`username`, `major`,`campusID`,`preferredName`) VALUES ('".$username."', '".$_POST['major']."', '".$_POST['campusID']."', '".$_POST['preferredName']."')";
                $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                
                header('Location: ../StudentManager/studentHome.php');
            } else {
                header('Location: ../AdvisorManager/advisorHome.php');
            }
        }
  }

  function sticky($name, $default = false) {
    if(isset($_POST[$name])) 
        echo(" value=".$_POST[$name]); 
    else if ($default)
        echo(" value=".$default);
    }

    function stickySelect($name, $value, $default) {
        if(isset($_POST[$name])) {
            if ($_POST[$name] == $value) { 
                echo(" selected"); 
            }
        }
        else if ($value == $default) {
            echo(" selected");
        }
    }
  
?>
