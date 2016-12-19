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
				<form action="advisorHome.php" method="post"><button type="submit" class="BackButton"><span>back</span></button></form>
			</div>
			<?php
				include_once("../Utilities/phpFuns.php");
                                session_start();
                                if(!$_SESSION['userToken']) { header('Location: ../LoginPage/login.php'); }
                                if($_SESSION['userRole'] != "advisor") {header('Location: ../LoginPage/processLogout.php');}
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



						
			     		// if no errors, create new account
					if (!isset($_POST['errors'])) {
						
						$sql = "INSERT INTO `users` (`lastName`, `firstName`, `username`, `userRole`, `email`, `password`) VALUES ('".$_POST['lastName']."', '".$_POST['firstName']."', '".$username."', '".$_POST['userRole']."', '".$_POST['email']."', '".sha1($_POST['password'])."')";
						$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
						
						// set user in session and redirect to appropriate user homepage
				  
						header('Location: ../AdvisorManager/advisorHome.php');
					}
				
				}

			?>
			
			<form class="Main-Form" id="advisorForm" action='createAdvisor.php' method='post'>
				<div>Advisor</div>
				<input value="advisor" name="userRole" class="formSelect" >
				<input placeholder="First Name" class="inputField" type='varchar' size='10' maxlength='40' name='firstName' value="<?php if(isset($_POST['firstName'])) echo($_POST['firstName']); ?>" required>
				<input placeholder="Last Name" class="inputField" type='varchar' size='10' maxlength='40' name='lastName' value="<?php if(isset($_POST['lastName'])) echo($_POST['lastName']); ?>" required>
				<input placeholder="E-mail Address" class="inputField" type='email' name='email' size='15' placeholder="Ex: jDoe1@umbc.edu" value="<?php if(isset($_POST['email'])) echo($_POST['email']); ?>" required>

				<input placeholder="Password" class="inputField" type='password' name='password' size='10' maxlength='40' required>
				<input placeholder="Confirm Password" class="inputField" type='password' name='confirmPass' size='10' maxlength='40' required>
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
