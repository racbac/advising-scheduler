<?php
$awayCheck = fopen("../closed.txt", "r");
$check = fgetc($awayCheck);
fclose($awayCheck);

$awayEdit = fopen("../closed.txt", "w");
if($check == "t"){
  fwrite($awayEdit, "f");
}
else{
  fwrite($awayEdit, "t");
}

?>