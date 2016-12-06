<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
class Common {    
   var $conn;
   var $debug;

	//constructor
	function Common($debug) {	
	  $this->debug = $debug;
	  $rs = $this->connect("cganley1"); 
	  return $rs;
	}	

	//opens db connection
   	function connect($db) {
	  $conn = @mysql_connect("studentdb-maria.gl.umbc.edu", "cganley1", "peasandcarrots") or die("Could not connect to MySQL");
	  $rs = @mysql_select_db($db, $conn) or die("Could not connect select $db database");
	  $this->conn = $conn;
	} 

	//executes a given query
   	function executeQuery($sql, $filename) {
	  if($this->debug == true) { echo("$sql <br>\n"); }
	  $rs = mysql_query($sql, $this->conn) or die("Could not execute query '$sql' in $filename");
	  return $rs;
   	}
} 
?>
