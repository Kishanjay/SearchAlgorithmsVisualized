<?php
/*
* Print an array of unsorted numbers
*
*
*/

$minNumber = 0;
$maxNumber = 50;
$length = 8;
$numbers = array();

for ($i = 0; $i < $length; $i++){
	$newnum = rand($minNumber, $maxNumber);
	if (in_array($newnum, $numbers)){
		$i --;
		continue;
	}
	$numbers[] = $newnum;
}

print_r (json_encode($numbers));
?>