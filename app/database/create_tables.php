<?php

require_once __DIR__ . '/db.class.php';

create_table_users();
create_table_projects();
create_table_members();

function create_table_users()
{
	$db = DB::getConnection();

	try {
		$st = $db->prepare(
			'CREATE TABLE IF NOT EXISTS dz2_users (' .
				'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
				'username varchar(50) NOT NULL,' .
				'password_hash varchar(255) NOT NULL,' .
				'email varchar(50) NOT NULL,' .
				'registration_sequence varchar(20) NOT NULL,' .
				'has_registered int)'
		);

		$st->execute();
	} catch (PDOException $e) {
		exit("PDO error (create_table_users): " . $e->getMessage());
	}
}

function create_table_projects()
{
	$db = DB::getConnection();

	try {
		$st = $db->prepare(
			'CREATE TABLE IF NOT EXISTS dz2_projects (' .
				'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
				'id_user int NOT NULL,' .
				'title varchar(50) NOT NULL,' .
				'abstract varchar(1000) NOT NULL,' .
				'number_of_members int NOT NULL,' .
				'status varchar(10) NOT NULL)'
		);

		$st->execute();
	} catch (PDOException $e) {
		exit("PDO error (create_table_projects): " . $e->getMessage());
	}
}

function create_table_members()
{
	$db = DB::getConnection();

	try {
		$st = $db->prepare(
			'CREATE TABLE IF NOT EXISTS dz2_members (' .
				'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
				'id_project INT NOT NULL,' .
				'id_user INT NOT NULL,' .
				'member_type varchar(20) NOT NULL)'
		);

		$st->execute();
	} catch (PDOException $e) {
		exit("PDO error (create_table_projects): " . $e->getMessage());
	}
}
