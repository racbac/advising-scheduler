<!--
Project: CMSC331 Project 02, Fall 2016
Authors: Felipe Bastos, Rachel Backert, Travis Earley, Nathaniel Fuller, Colin Ganley
Date: 2016-12-16
Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
Users enter new account information using this sticky form. 
-->
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
    <head>
       <title>Create an account</title>
		<link rel="icon" type="image/png" href="http://sites.umbc.edu/wp-content/themes/umbc/assets/images/icon.png">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:300" rel="stylesheet">
		<link href="../main.css" rel="stylesheet" type="text/css">
    </head>
	<body>
		<div id="wrapper">
			<header>
				<div id="Top-Header">
					<div id="Page-Title">
						<a class="Title">create an account</a>
					</div>
					<a href="http://umbc.edu"><img src="../umbc50.png" title="UMBC: An Honors University in Maryland" class="umbc-logo"></a>
				</div>
				<div id="Cnms-Banner">
					<a href="http://cnms.umbc.edu"><img src="../cnms.png" class="banner"></a>
				</div>
			</header>
			<div class="BackDiv">
				<form action="login.php" method="post"><button type="submit" class="BackButton"><span>back</span></button></form>
			</div>
			<form class="Main-Form" action='createAccount.php' method='post'>
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
        $username = substr($_POST['email'], 0, strpos($_POST['email'], "@"));
        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
        $row = mysql_fetch_row($rs);
        if($row) {
            echo("Account for this UMBC ID already exists.<br/>"); 
            $_POST['errors'] = 1;
        }
        // make students are CMNS majors
        if ($_POST['userRole'] == "student" && $_POST['major'] == "Other") {
            echo("You have indicated that you plan to pursue a major other than one of the following, beginning next semester: Biological Sciences B.A., Biological Sciences B.S., Biochemistry & Molecular Biology B.S., Bioinformatics & Computational Biology B.S., Biology Education B.A., Chemistry B.A., Chemistry B.S., or Chemistry Education B.A.. In order to obtain the BEST advice about course selection, degree progress, and academic policy, please meet with a representative of the department that administers your NEW major.</br>
            You can find advising contact information for your new major on the Office for Academic and Pre-Professional Advising Office’s Departmental Advising page. That contact person/office will be able to give you instructions on how to schedule an advising appointment with someone in that area. </br>
            Good luck with your new major!");
            exit();
        }
    
        // if no errors, create new account
        if (!isset($_POST['errors'])) {
            
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
  
?>
			
				<div class="Group-Appointment">
					<a class="Descriptor">are you a student or advisor?</a>
					<div id="RadialPanel">
						<span class="RadialSelector">
							<label class="RadialDescriptor" for="student_rb">student</label> <input id="student_rb" type="radio" name="userRole" value="student" checked>
						</span>
						<span class="RadialSelector">
							<input type="radio" name="userRole" id="advisor_rb" value="advisor"> <label class="RadialDescriptor" for="advisor_rb">advisor</label>
						</span>
					</div>
				</div>
				
				<input placeholder="First Name" class="inputField" type='varchar' size='10' maxlength='40' name='firstName' value="<?php if(isset($_POST['firstName'])) echo($_POST['firstName']); ?>" required>
				<input placeholder="Last Name" class="inputField" type='varchar' size='10' maxlength='40' name='lastName' value="<?php if(isset($_POST['lastName'])) echo($_POST['lastName']); ?>" required>
				
				<input placeholder="Preferred Name" class="inputField" type='varchar' size='10' maxlength='40' name='preferredName' value="<?php if(isset($_POST['preferredName'])) echo($_POST['preferredName']); ?>" >

				<input placeholder="E-mail Address" class="inputField" type='email' name='email' size='15' placeholder="Ex: jDoe1@umbc.edu" value="<?php if(isset($_POST['email'])) echo($_POST['email']); ?>" required>

				<input placeholder="Campus ID" class="inputField" type='varchar' size='7' maxlength='7' name='campusID' placeholder="Ex: AB12345" value="<?php if(isset($_POST['campusID'])) echo($_POST['campusID']); ?>" required>

				<input placeholder="Password" class="inputField" type='password' name='password' size='10' maxlength='40' required>
				<input placeholder="Confirm Password" class="inputField" type='password' name='confirmPass' size='10' maxlength='40' required>

				<div id="major">
					<select name="major" class="LargeSelect">
						<option value="Biological Sciences B.A.">Biological Sciences B.A.</option>
						<option value="Biological Sciences B.S.">Biological Sciences B.S.</option>
						<option value="Biochemistry & Molecular Biology B.S.">Biochemistry & Molecular Biology B.S.</option>
						<option value="Bioinformatics & Computational Biology B.S.">Bioinformatics & Computational Biology B.S.</option>
						<option value="Biology Education B.A.">Biology Education B.A.</option>	
						<option value="Chemistry B.A.">Chemistry B.A.</option>
						<option value="Chemistry B.S.">Chemistry B.S.</option>
						<option value="Chemistry Education B.A.">Chemistry Education B.A.</option>
						<option value="Other">Other</option>
					</select>
				</div>

				<div>
					<button class="submit" id="Register" type='submit' name='submit'><span>register</span></button>
				</div>
			</form>
			<div id="Inner-Footer">
				<div class="main-inner-footer-field">College of Natural and Mathematical Sciences</div>
				<div class="inner-footer-field">University Center Room 116</div>
				<div class="inner-footer-field">(410) 455-5827</div>
				<div class="inner-footer-field"><a class="inner-footer-link" href="mailto:cnms@umbc.edu">cnms@umbc.edu</a></div>
			</div>
		</div>
		<div id="Footer">
			<div>
				<a href="http://umbc.edu"><img src="../footer.png" title="UMBC: An Honors University in Maryland" class="umbc-footer"></a>
			</div>
			<div>
				<a href="http://about.umbc.edu">About UMBC</a> 
				| 
				<a href="http://about.umbc.edu/visitors-guide/contact-us">Contact Us</a> 
				| 
				<a href="http://umbc.edu/go/equal-opportunity">Equal Opportunity</a> 
				| 
				Follow UMBC:
				<a href="https://facebook.com/umbcpage" title="Follow on Facebook">
					<img class="facebook-footer" src="../fbft.png">
				</a> 
				<a href="https://twitter.com/umbc" title="Follow on Twitter">
					<img class="twitter-footer" src="../twft.png">
				</a> 
				<a href="http://umbc.edu/news" title="UMBC News">
					<img class="rss-footer" src="../rssft.png">
				</a>
			</div>
			<div>
				© University of Maryland, Baltimore County  •  1000 Hilltop Circle  •  Baltimore, MD 21250
			</div>
		</div>	
	</body>
</html>
