<?php
session_start();
include('CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$first = $_SESSION['newFirst'];
$last = $_SESSION['newLast'];
$umbc_ID = $_SESSION['newUmbcID'];
$pass = $_SESSION['newPass'];
$encrypted_pass = md5($pass);
$email = $_SESSION['email'];
$majors = $_SESSION['majors'];
$_SESSION['studentExists'] = false;

# Check to see if student already exists
$sql = "SELECT * FROM `students_basic_info` WHERE `umbc_ID` = '$umbc_ID' AND `lname` = '$last' AND `fname` = '$first'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
if($row)
  {
    $_SESSION['studentExists'] = true;
    header('Location: registerStudent.php');
  }
else
  {
# Set up Insert query to insert info into student basic info table
    $sql = "INSERT INTO `students_basic_info`(`id`, `lname`, `fname`, `umbc_ID`, `email`, `password`, `bio_ba`, `bio_bs`, `biochem_bs`, `bioinfo_bs`, `bioedu_ba`, `chem_ba`, `chem_bs`, `chemedu_ba`)" . " VALUES ('', '$last', '$first', '$umbc_ID', '$email', '$encrypted_pass'";

# Array for possible selections of majors
    $cols = array('bio_ba', 'bio_bs', 'biochem_bs', 'bioinfo_bs', 'bioedu_ba', 'chem_ba', 'chem_bs', 'chemedu_ba');

    if(isset($majors))
      {

# Loop that adds on to the sql query a 1 or 0 for each major, depending if it was selected or not
	foreach($cols as $col)
	  {
	    if(in_array($col, $majors))
	      {
		$flag = 1;
	      }
	    else $flag = 0;

	    $sql .= ", $flag";
	  }

# Close the parentheses of the sql query
	$sql .= ')';
	echo $sql;
      }

    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $_SESSION['umbc_ID'] = $_SESSION['newUmbcID'];
    header('Location: homescreen.php');
  }
?>