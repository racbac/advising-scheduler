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
    echo("Passwords do not match.");
  }

if($_SESSION['studentExists'] == true)
  {
    echo("Student already exists.");
  }
?>

<form action='setStudent.php' method='post'>

  First Name: <input type='varchar' size='25' maxlength='40' name='fname' required><br/><br/>
  Last Name: <input type='varchar' size='25' maxlength='40' name='lname' required><br/><br/>
  Student ID: <input type='varchar' size='7' maxlength='10' name='umbc_ID' required><br/><br/>
  Email: <input type='email'name='email' required><br/><br/>
  Password: <input type='password' name='password' required><br/><br/>
  Re-enter Password: <input type='password' name='confirmPass' required><br/><br/> 

  Select Major(s):<br/>
  <select name='majors[]' multiple='multiple'>
  <option value='bio_ba'>Biological Sciences BA</option>
  <option value='bio_bs'>Biological Sciences BS</option>
  <option value='biochem_bs'>Biochemistry & Molecular Biology BS</option>
  <option value='bioinfo_bs'>Bioinformatics & Computational Biology BS</option>
  <option value='bioedu_ba'>Biological Education BA</option>
  <option value='chem_ba'>Chemistry BA</option>
  <option value='chem_bs'>Chemistry BS</option>
  <option value='chemedu_ba'>Chemistry Education BA</option>
  </select><br/><br/>


  <input type='submit' value='Register'>


</form>

</body>
</html>
