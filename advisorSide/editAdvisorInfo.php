<?php
session_start();
?>
<html>
<head>
<title></title>
</head>
<body>

<?php
if($_SESSION['confirmedPass'] == true)
  {
    echo "Passwords do not match.";
  }

if($_SESSION['advisorExists'] == true)
  {
    echo "Advisor already exists.";
  }
?>

<form action='updateAdvisorInfo.php' method='post' name='UpdateProfile'>
  First Name: <input type='text' size='25' maxlength='25' name='fname' required><br/>
  Last Name: <input type='text' size='25' maxlength='25' name='lname' required><br/><br/>
  Username: <input type='text' size='25' maxlength='25' name='username' required><br/>
  Password: <input type='password' size='25' maxlength='50' name='pass' required><br/>
  Confirm Password: <input type='password' size='25' maxlength='50' name='confirmPass' required><br/><br/>
  Office Location: <input type='text' size='25' maxlength='10' name='office' required><br/><br/>
  Email: <input type='email' size='25' maxlength='50' name='email' required><br/><br/>
  Select Majors to Advise:<br/>
  <select name='majors[]' multiple='multiple'>
  <option value='bsci_BA'>Biological Sciences BA</option>
  <option value='bsci_BS'>Biological Sciences BS</option>
  <option value='bchem_BS'>Biochemistry & Molecular Biology BS</option>
  <option value='binf_BS'>Bioinformatics & Computational Biology BS</option>
  <option value='bsciEd_BA'>Biology Education BA</option>
  <option value='chem_BA'>Chemistry BA</option>
  <option value='chem_BS'>Chemistry BS</option>
  <option value='chemEd_BA'>Chemistry Education BA</option>
  </select><br/><br/>
  <input type='submit' value='Update Profile'>
</form>


</body>
</html>
