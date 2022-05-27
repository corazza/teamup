<?php

class DB
{
	private static $db = null;

	private function __construct()
	{
	}

	private function __clone()
	{
	}

	public static function getConnection()
	{
		if (DB::$db === null) {
			try {
				DB::$db = new PDO("mysql: host=localhost; dbname=druga_zadaca; charset=utf8", 'druga_zadaca', 'druga_zadaca');
				DB::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				exit('PDO Error: ' . $e->getMessage());
			}
		}
		return DB::$db;
	}
}
