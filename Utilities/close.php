<?php
require_once("../CommonMethods.php");
$COMMON = new Common(false);
$sql = "SELECT `closed` FROM `offseason` WHERE `i` = 1";
$rs = $COMMON->executeQuery($sql, array(), $_SERVER['SCRIPT_NAME']);
$check = $rs->fetch(PDO::FETCH_NUM)[0];
if ($check == 1){
  $sql = "UPDATE `offseason` SET `closed` = 0 WHERE `i` = 1";
  $rs = $COMMON->executeQuery($sql, array(), $_SERVER['SCRIPT_NAME']);
}

else{
  $sql = "UPDATE `offseason` SET `closed` = 1 WHERE `i` = 1";
  $rs = $COMMON->executeQuery($sql, array(), $_SERVER['SCRIPT_NAME']);
}
header("Location: ../AdvisorManager/advisorHome.php");
?>