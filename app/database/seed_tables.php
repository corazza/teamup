<?php

require_once __DIR__ . '/db.class.php';
require_once __DIR__ . '/../util.php';

seed_table_users();
seed_table_projects();
seed_table_members();

function seed_table_users()
{
	if (!is_table_empty('dz2_users')) {
		return;
	}

	$db = DB::getConnection();

	try {
		$st = $db->prepare('INSERT INTO dz2_users(username, password_hash, email, registration_sequence, has_registered) VALUES (:username, :password, \'a@b.com\', \'abc\', \'1\')');

		$st->execute(array('username' => 'mirko', 'password' => password_hash('mirkovasifra', PASSWORD_DEFAULT)));
		$st->execute(array('username' => 'ana', 'password' => password_hash('aninasifra', PASSWORD_DEFAULT)));
		$st->execute(array('username' => 'maja', 'password' => password_hash('majinasifra', PASSWORD_DEFAULT)));
		$st->execute(array('username' => 'slavko', 'password' => password_hash('slavkovasifra', PASSWORD_DEFAULT)));
		$st->execute(array('username' => 'pero', 'password' => password_hash('perinasifra', PASSWORD_DEFAULT)));
	} catch (PDOException $e) {
		exit("PDO error (seed_table_users): " . $e->getMessage());
	}
}

function seed_table_projects()
{
	if (!is_table_empty('dz2_projects')) {
		return;
	}

	$db = DB::getConnection();

	try {
		$st = $db->prepare('INSERT INTO dz2_projects(id_user, title, abstract, number_of_members, status) VALUES (:id, :t, :a, :no, :st)');

		$st->execute(array('id' => 1, 't' => 'Igra - Go', 'a' => 'Implementirat ćemo Go u kojem korisnik može igrati protiv AI-ja.', 'no' => 3, 'st' => 'open')); // mirko
		$st->execute(array('id' => 2, 't' => 'Novi Fejsbuk', 'a' => 'U ovom projektu napravit ćemo novi Fejsbuk koji će još skupljati još više informacija o svojim korisnicima i koji će
					još češće i još slučajnije curiti te informacije trećim stranama.', 'no' => '5', 'st' => 'open')); // ana
		$st->execute(array('id' => 3, 't' => 'Web-aplikacija za recepte', 'a' => 'Napravit ćemo aplikaciju sa svim receptima iz kuharice moje bake.', 'no' => 4, 'st' => 'open')); // maja
		$st->execute(array('id' => 1, 't' => 'Kao Amazon, ali bolje', 'a' => 'Jeff Bezos nema pojma, naš Amazon će biti puno bolji.', 'no' => 2, 'st' => 'closed')); // mirko
		$st->execute(array('id' => 4, 't' => 'Projekt za RP2', 'a' => 'Već ćemo nešto smisliti, prvo idemo okupiti tim.', 'no' => 4, 'st' => 'open')); // slavko
	} catch (PDOException $e) {
		exit("PDO error (seed_table_users): " . $e->getMessage());
	}
}

function seed_table_members()
{
	if (!is_table_empty('dz2_members')) {
		return;
	}

	$db = DB::getConnection();

	try {
		$st = $db->prepare('INSERT INTO dz2_members(id_project, id_user, member_type) VALUES (:id_project, :id_user, :type)');

		$st->execute(array('id_project' => 1, 'id_user' => 1, 'type' => 'member')); // autor (mirko) - go
		$st->execute(array('id_project' => 2, 'id_user' => 2, 'type' => 'member')); // autor (ana) - fejsbuk
		$st->execute(array('id_project' => 3, 'id_user' => 3, 'type' => 'member')); // autor (maja) - recepti
		$st->execute(array('id_project' => 4, 'id_user' => 1, 'type' => 'member')); // autor (mirko) - amazon
		$st->execute(array('id_project' => 5, 'id_user' => 4, 'type' => 'member')); // autor (slavko) - rp2
		$st->execute(array('id_project' => 2, 'id_user' => 3, 'type' => 'invitation_accepted')); // maja - fejsbuk
		$st->execute(array('id_project' => 2, 'id_user' => 5, 'type' => 'application_accepted')); // pero - fejsbuk
		$st->execute(array('id_project' => 4, 'id_user' => 4, 'type' => 'application_accepted')); // slavko - amazon
		$st->execute(array('id_project' => 3, 'id_user' => 5, 'type' => 'member')); // pero - recepti
		$st->execute(array('id_project' => 3, 'id_user' => 1, 'type' => 'application_pending')); // mirko - recepti
		$st->execute(array('id_project' => 5, 'id_user' => 2, 'type' => 'invitation_pending')); // ana - rp2
	} catch (PDOException $e) {
		exit("PDO error (seed_table_users): " . $e->getMessage());
	}
}
