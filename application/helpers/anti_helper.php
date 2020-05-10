<?php 

function anti_b($text)
{
	global $mysqli;
	$safe=$mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($text,ENT_QOUTES))));
	return $safe;
}