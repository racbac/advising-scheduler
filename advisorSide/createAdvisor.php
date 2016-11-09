<?php
session_start();
#var_dump($_POST);
include('../../../CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$first = $_SESSION['newFirst'];
$last = $_SESSION['newLast'];
$user = $_SESSION['newUsername'];
$pass = $_SESSION['newPass'];
$encrypted_pass = md5($pass);
$office = $_SESSION['office'];
$email = $_SESSION['email'];
$majors = $_SESSION['majors'];
$_SESSION['advisorExists'] = false;

# First check to see if advisor already exists, based on querying fname, lname, and username
$sql = "SELECT * FROM `advisor_info` WHERE `username` = '$user' AND `lname` = '$last' AND `fname` = '$first'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
if($row)
  {
    $_SESSION['advisorExists'] = true;
    header('Location: advisorInfo.php');
  }
else
  {

/* # Insert username and password into advisor_accounts table */
/* $sql = "INSERT INTO `advisor_accounts`(`id`, `username`, `password`) VALUES ('', '$user', '$encrypted_pass')"; */
/* $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]); */

# First query to insert basic advisor info into the advisor_info table
    $sql = "INSERT INTO `advisor_info`(`id`, `username`, `password`, `lname`, `fname`, `office`, `email`) VALUES ('', '$user', '$encrypted_pass', '$last', '$first', '$office', '$email')";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    if(isset($majors))
      {
# Query to get the id number of the advisor based on matching email
	$sql = "SELECT `id` FROM `advisor_info` WHERE `email` = '$email'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	$row = mysql_fetch_row($rs);
	echo ("Id number is: " . $row['0'] . "<br/>");
	$id = $row['0'];
	#$_SESSION['advisorId'] = $id;

# Array for possible selections of majors the advisor could advise
	$cols = array('bsci_BA', 'bsci_BS', 'bchem_BS', 'binf_BS', 'bsciEd_BA', 'chem_BA', 'chem_BS', 'chemEd_BA');
    
# Start of the query to insert selected majors into the advisors_majors table
	$query = "INSERT INTO `advisors_majors`(`id`, `bsci_BA`, `bsci_BS`, `bchem_BS`, `binf_BS`, `bsciEd_BA`, `chem_BA`, `chem_BS`, `chemEd_BA`)" . " VALUES ($id";

# Loop that adds on to the query a 0 or 1 for each major, depending if the advisor selected it or not
	foreach($cols as $col)
	  {
	    if(in_array($col, $majors))
	      {
		$flag = 1;
	      }
	    else $flag = 0;

	    $query .= ", $flag";
	  }

# Close the parentheses of the query
	$query .= ')';

      }

    $rsMajor = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
    echo("Advisor Profile saved.");
    $_SESSION['username'] = $_SESSION['newUsername'];
    header('Location: advisorHome.php');
  }
?>