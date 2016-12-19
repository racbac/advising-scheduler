<?php

include('../CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);
$sql = "SELECT `closed` FROM `offseason` WHERE `i` = 1";
$rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
$check = mysql_fetch_row($rs)[0];
if ($check == 0){
  $sql = "UPDATE `offseason` SET `closed` = 1 WHERE `i` = 1";
  $rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
}
else{
  $sql = "UPDATE `offseason` SET `closed` = 0 WHERE `i` = 1";
  $rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
}

header("Location: ../AdvisorManager/advisorHome.php")
?>