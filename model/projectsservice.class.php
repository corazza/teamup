<?php

require_once __DIR__ . '/../app/database/db.class.php';

class ProjectsService
{
    public function allProjects()
    {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT * FROM dz2_projects');
            $st->execute(array());
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.allProjects): ' . $e->getMessage());
        }

        $projects = array();
        while ($row = $st->fetch()) {
            array_push($projects, $row);
        }
        return $projects;
    }

    public function projectsForUser($user_id)
    {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT * FROM dz2_projects WHERE dz2_projects.id IN
            	(SELECT id_project FROM dz2_members WHERE dz2_members.id_user = :user_id
                AND (dz2_members.member_type = "member"
                OR dz2_members.member_type = "invitation_accepted"
                OR dz2_members.member_type = "application_accepted"))');
            $st->execute(array('user_id' => $user_id));
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.projectsForUser): ' . $e->getMessage());
        }

        $projects = array();
        while ($row = $st->fetch()) {
            array_push($projects, $row);
        }
        return $projects;
    }

    public function getProject($id)
    {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT * FROM dz2_projects WHERE id=:id');
            $st->execute(array('id' => $id));
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.getProject): ' . $e->getMessage());
        }

        return $st->fetch();
    }

    public function userMap()
    {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT id, username FROM dz2_users');
            $st->execute(array());
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.userMap): ' . $e->getMessage());
        }

        $userMap = array();
        while ($row = $st->fetch()) {
            $userMap[$row['id']] = $row;
        }
        return $userMap;
    }

    public function members($project_id)
    {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT id_user FROM dz2_members WHERE id_project=:id_project
                AND (member_type = "member"
                OR member_type = "invitation_accepted"
                OR member_type = "application_accepted")');
            $st->execute(array('id_project' => $project_id));
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.members): ' . $e->getMessage());
        }

        $members = array();
        while ($row = $st->fetch()) {
            array_push($members, $row[0]);
        }
        return $members;
    }

    public function startProject($author_id, $name, $description, $num_members) {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('INSERT INTO dz2_projects (id_user, title, abstract, number_of_members, status)
                    VALUES (:author_id, :name, :description, :num_members, "open")');
            $st->execute(array('author_id' => $author_id, 'name' => $name, 'description' => $description, 'num_members' => $num_members));
            $last_project_id = $db->lastInsertId();
            $st = $db->prepare('INSERT INTO dz2_members (id_project, id_user, member_type) VALUES (:id_project, :id_user, "member")');
            $st->execute(array('id_project' => $last_project_id, 'id_user' => $author_id));
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.startProject): ' . $e->getMessage());
        }
    }

    public function memberType($project_id, $user_id) {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT member_type FROM dz2_members WHERE id_user=:user_id AND id_project=:project_id');
            $st->execute(array('project_id' => $project_id, 'user_id' => $user_id));
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.memberType): ' . $e->getMessage());
        }

        $row = $st->fetch();
        if ($row === false) {
            $row = array(0 => "");
        }
        return $row[0];
    }

    public function apply($user_id, $project_id) {
        $db = DB::getConnection();

        echo $user_id;
        echo $project_id;

        try {
            $st = $db->prepare('INSERT INTO dz2_members (id_user, id_project, member_type)
                    VALUES (:user_id, :project_id, "application_pending")');
            $st->execute(array('user_id' => $user_id, 'project_id' => $project_id));
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.startProject): ' . $e->getMessage());
        }
    }
};
