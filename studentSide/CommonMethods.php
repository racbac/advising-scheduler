<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php 

class Common
{     
   var $conn;
   var $debug;
		
	function Common($debug)
	{
	$this->debug = $debug; 
	$rs = $this->connect("XXXXXXX"); // db name really here
	return $rs;
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
   
   function connect($db)// connect to MySQL
   {
	$conn = @mysql_connect("studentdb-maria.gl.umbc.edu", "XXXXXXXX", "XXXXXXXX") or die("Could not connect to MySQL");
	      $rs = @mysql_select_db($db, $conn) or die("Could not connect select $db database");
	      	  $this->conn = $conn; 
		  }

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
   
   function executeQuery($sql, $filename) // execute query
   {
	if($this->debug == true) { echo("$sql <br>\n"); }
	$rs = mysql_query($sql, $this->conn) or die("Could not execute query '$sql' in $filename"); 
	return $rs;
   }			

} // ends class, NEEDED!!

?>
