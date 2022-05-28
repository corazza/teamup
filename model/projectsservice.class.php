<?php

require_once __DIR__ . '/../app/database/db.class.php';



class ProjectsService
{
    public function allProjects() {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT * FROM dz2_projects');
            $st->execute(array());
        } catch (PDOException $e) {
            exit('Greška u bazi: ' . $e->getMessage());
        }


        $projects = array();
        while ($row = $st->fetch()) {
            array_push($projects, $row);
        }
        return $projects;
    }

    public function userMap() {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT id, username FROM dz2_users');
            $st->execute(array());
        } catch (PDOException $e) {
            exit('Greška u bazi: ' . $e->getMessage());
        }

        $userMap = array();
        while ($row = $st->fetch()) {
            array_push($userMap, $row);
        }
        return $userMap;
    }
};
