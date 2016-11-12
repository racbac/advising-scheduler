/*phpHeader
 * Project: CMSC331 Project 02, Fall 2016
 * Authors: Felipe Bastos, Rachel Brackert, Travis Earley, Nathaniel Fuller, Colin Ganley
 * Date: 2016-12-16
 * Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
 *
 */

<html>
<head>
<style>
input[type=submit]{
  background-color: #ffcc00;
  border: none;
  color: #000000;
  text-decoration: none;
  margin: 4px 2px;
  text-transform: uppercase;
 }
</style>
</head>
<body>
<form>
<form action='processHome.php' method='post' name='studemtHome'>
<input type='submit' name='next' value='Search for An Appointment'><br/><br/>
<input type='submit' name='next' value='View My Appointment'><br/><br/>
<input type='submit' name='next' value='Pre-Advising Worksheet'><br/><br/>
<input type='submit' name='next' value='Edit My Information'><br/><br/>
<input type='submit' name='next' value='Logout'><br/>
</form>
</body>
</html>
