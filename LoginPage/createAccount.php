<!--
MSC331 Project 02, Fall 2016
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
			<?php
				include_once("../Utilities/phpFuns.php");
				if(isset($_POST['submit'])) {
					// verify that passwords match
					if($_POST['confirmPass'] != $_POST['password']) {
						echo("<div class='ErrorDiv'>
							<div class='InnerErrorDiv'>
							  <a class='ErrorBackground'>error</a>
							  <a class='Error'>Passwords do not match.</a>
							</div>
						  </div>");
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
						echo("<div class='ErrorDiv'>
							<div class='InnerErrorDiv'>
							  <a class='ErrorBackground'>error</a>
							  <a class='Error'>Account for the UMBC username already exists.</a>
							</div>
						  </div>"); 
						$_POST['errors'] = 1;
					}
					// make students are CMNS majors
					if ($_POST['userRole'] == "student" && $_POST['major'] == "Other") {
						
						echo("<div class='ErrorDiv'>
                                <div class='InnerErrorDiv' id='OtherMajor'>
                                <a class='ErrorBackground'>error</a>
                                <a class='Error'>You have indicated that you plan to pursue a major other than one of the following, beginning next semester:<ul><li>Biological Sciences B.A.</li><li>Biological Sciences B.S.</li><li>Biochemistry & Molecular Biology B.S.</li><li>Bioinformatics & Computational Biology B.S.</li><li>Biology Education B.A.</li><li>Chemistry B.A.</li><li>Chemistry B.S.</li><li>Chemistry Education B.A.</li></ul> In order to obtain the BEST advice about course selection, degree progress, and academic policy, please meet with a representative of the department that administers your NEW major.</br>You can find advising contact information for your new major on the Office for Academic and Pre-Professional Advising Office’s Departmental Advising page. That contact person/office will be able to give you instructions on how to schedule an advising appointment with someone in that area.</a></div></div>");
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
							$sql = "INSERT INTO `students_academic_info` (`username`, `major`,`campusID`,`preferredName`,`futurePlans`, `advisingQuestions`) VALUES ('".$username."', '".$_POST['major']."', '".$_POST['campusID']."', '".$_POST['preferredName']."', '".$_POST['futurePlans']."', '".$_POST['questions']."')";
							$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
							
							header('Location: ../StudentManager/studentHome.php');
						} else {
							header('Location: ../AdvisorManager/advisorHome.php');
						}
					}
				}

			?>
			
			<form class="Main-Form" id="studentForm" action='createAccount.php' method='post'>
				<div>Student</div>
				<input value="student" name="userRole" class="formSelect" >
				<input placeholder="First Name" class="inputField" type='varchar' size='10' maxlength='40' name='firstName' <?php sticky("firstName"); ?> required>
				<input placeholder="Preferred Name" class="inputField" type='varchar' size='10' maxlength='40' name='preferredName' <?php sticky("preferredName"); ?> >
				<input placeholder="Last Name" class="inputField" type='varchar' size='10' maxlength='40' name='lastName' <?php sticky("lastName"); ?> required>
				
				<input placeholder="E-mail Address" class="inputField" type='email' name='email' size='15' placeholder="Ex: jDoe1@umbc.edu" <?php sticky("email"); ?> required>
				<input placeholder="Campus ID" class="inputField" type='varchar' size='7' maxlength='7' name='campusID' placeholder="Ex: AB12345" <?php sticky("campusID"); ?> required>

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
					<textarea class="inputField" name="futurePlans" rows="3" required placeholder="What are your current post-UMBC plans? For example: medical School, teach middle school science, research career, master’s/PhD, etc." <?php sticky("futurePlans"); ?> ></textarea>
				</div>
				<div>
					<textarea class="inputField" name="questions" rows="6" placeholder="Do you have any questions or concerns that you would like to discuss during your advising session? For example: Withdrawing from a course, adding a second major, etc. Note that certain questions and concerns may require more time for discussion than a student’s Registration Advising appointment will allow. If your question or concern is complex, or is sensitive in nature, you may be asked to schedule a follow-up appointment with an advisor to address it fully." ></textarea>
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
