<?php

require_once __DIR__ . '/database/db.class.php';

function read_from_aux($filename)
{
	$filename = __DIR__ . '/../aux/' . $filename;
	return file_get_contents($filename);
}

function words_table_name($length)
{
	return "words_" . $length;
}

function is_table_empty($table_name)
{
	$db = DB::getConnection();

	try {
		$st = $db->prepare('SELECT COUNT(1) WHERE EXISTS (SELECT * FROM ' . $table_name . ')');
		$st->execute(array());
	} catch (PDOException $e) {
		exit("PDO error (is_table_empty): " . $e->getMessage());
	}

	$row = $st->fetch();
	return intval($row[0]) === 0;
}

function ifeq($first, $second, $yes, $no)
{
	if (strcmp($first, $second) === 0) {
		return $yes;
	} else {
		return $no;
	}
}

function display_error($error_message)
{
	echo "<br />";
	echo '<p class="errormessage">' . $error_message . '</p>';
	echo "<br />";
}

function debug()
{
	echo "<br />";
	echo "<br />";
	echo "<hr />";
	echo "<br />";
	echo '$_POST:<br/>';
	echo "<br />";
	print_r($_POST);
	echo "<br />";
	echo "<br />";
	echo "<br />";
	echo '$_SESSION:<br/>';
	echo "<br />";
	print_r($_SESSION);
	echo "<br />";
	echo '$_GET:<br/>';
	echo "<br />";
	print_r($_GET);
	echo "<br />";
}

function considered_member($member_type) {
	return in_array($member_type, array("member", "invitation_accepted", "application_accepted"));
}
