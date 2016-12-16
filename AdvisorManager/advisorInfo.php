<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Backert, Travis Earley, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->
<?php

session_start();

//if(!$_SESSION['userToken']) { header('Location: ../error.html'); }

?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
    <head>
       <title>Create New Advisor</title>
		<link rel="icon" type="image/png" href="http://sites.umbc.edu/wp-content/themes/umbc/assets/images/icon.png">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:300" rel="stylesheet">
		<link href="../main.css" rel="stylesheet" type="text/css">
    </head>
	<body>
		<div id="wrapper">
			<header>
				<div id="Top-Header">
					<div id="Page-Title">
						<a class="Title">create new advisor</a>
					</div>
					<a href="http://umbc.edu"><img src="../umbc50.png" title="UMBC: An Honors University in Maryland" class="umbc-logo"></a>
				</div>
				<div id="Cnms-Banner">
					<a href="http://cnms.umbc.edu"><img src="../cnms.png" class="banner"></a>
				</div>
			</header>
			<form action="../LoginPage/processLogout.php" method="post" style="text-align: center;">
				<button type="submit" class="Logout"><span>logout</span></button>
			</form>
			<div class="BackDiv">
				<form action="../AdvisorManager/advisorHome.php" method="post"><button type="submit" class="BackButton"><span>back</span></button></form>
			</div>

			<div class="Main-Form">
				<form action='processNewAdvisor.php' method='post' name='NewAdvisorProfile'>
					<input class="inputField" placeholder="First Name" type='text' size='25' maxlength='25' name='fname' required>
					<input class="inputField" placeholder="Last Name" type='text' size='25' maxlength='25' name='lname' required>
					<input class="inputField" placeholder="Username" type='text' size='25' maxlength='25' name='username' required>
					<input class="inputField" placeholder="Password" type='password' size='25' maxlength='50' name='pass' required>
					<input class="inputField" placeholder="Confirm password" type='password' size='25' maxlength='50' name='confirmPass' required>
					<input class="inputField" placeholder="Office Location" type='text' size='25' maxlength='10' name='office' required>
					<input class="inputField" placeholder="E-mail address" type='email' size='25' maxlength='50' name='email' required>
					<div>
						<button name="submit" id="Create" class="submit"><span>create</span></button>
					</div>
				</form>
			</div>
				
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