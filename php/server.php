<?php

function validate_timezone($timezone) {
	return isset($timezone);
}

function validate_second_area($x, $y, $r){
	return ($x<=0 && $x>=-$r/2 && $y>=0 && $y<=$r/2 && sqrt($x*$x+$y*$y)<=$r/2);
}

function validate_third_area($x, $y, $r){
	return ($x<=0 && $x>=-$r && $y<=0 && $y>=-$r && $y>=-$x-$r);
}

function validate_fourth_area($x, $y, $r){
	return ($x>=0 && $x<=$r && $y<=0 && $y>=-$r);
}

session_start();

if (!isset($_SESSION['data']))
    $_SESSION['data'] = array();

$x = @$_GET["x_value"];
$y = @$_GET["y_value"];
$r = @$_GET["r_value"];
$timezone= @$_GET["timezone"];
$answer;
$data;

if(validate_timezone($timezone)){
	$hit_fact = ( validate_second_area($x, $y, $r) || validate_third_area($x, $y, $r) || validate_fourth_area($x, $y, $r)) ? "Hit": "Miss";
	$current_time = date("j M o G:i:s", time()-$timezone*60);
	$execution_time = round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 7);
	
	//$data = array("x"=>$x, "y"=>$y, "r"=>$r, "hit_fact"=>$hit_fact, "time"=>$current_time, "execution_time"=>$execution_time);

	$answer = array("x"=>$x, "y"=>$y, "r"=>$r, "hit_fact"=>$hit_fact, "time"=>$current_time, "execution_time"=>$execution_time);
	array_push($_SESSION['data'], $answer);
}
/*
echo "<tr class='columns'>";
echo "<td>" . $data['x'] . "</td>";
echo "<td>" . $data['y'] . "</td>";
echo "<td>" . $data['r'] . "</td>";
echo "<td>" . $data['hit_fact']  . "</td>";
echo "<td>" . $data['time']  . "</td>";
echo "<td>" . $data['execution_time'] . "</td>";
echo "</tr>";
*/

foreach ($_SESSION['data'] as $elem){
	echo "<tr class='columns'>";
	echo "<td>" . $elem['x'] . "</td>";
	echo "<td>" . $elem['y'] . "</td>";
	echo "<td>" . $elem['r'] . "</td>";
	echo "<td>" . $elem['hit_fact']  . "</td>";
	echo "<td>" . $elem['current_time']  . "</td>";
	echo "<td>" . $elem['execution_time'] . "</td>";
	echo "</tr>";
}

?>