<?php

require_once __DIR__ . '/../app/database/db.class.php';

class AppInvService
{
    public function allProjectsAppInv($user_id, $appinv)
    {
        $in_string = '("' . $appinv . '_pending", "' . $appinv .  '_accepted")';
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT dz2_members.member_type, dz2_projects.id, dz2_projects.status, dz2_projects.title, dz2_projects.id_user, dz2_projects.abstract
                FROM dz2_members JOIN dz2_projects
                WHERE dz2_members.id_project=dz2_projects.id AND dz2_members.id_user=:user_id AND dz2_members.member_type IN ' . $in_string);
            $st->execute(array('user_id' => $user_id));
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.allProjects): ' . $e->getMessage());
        }

        $projects = array();
        while ($row = $st->fetch()) {
            array_push($projects, $row);
        }
        return $projects;
    }

    public function allProjectsApplied($user_id)
    {
        return $this->allProjectsAppInv($user_id, 'application');
    }

    public function allProjectsInvited($user_id)
    {
        return $this->allProjectsAppInv($user_id, 'invitation');
    }

    public function correctStatus() {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('UPDATE dz2_members JOIN dz2_projects
            SET dz2_projects.status="closed"
            WHERE 	dz2_projects.id = dz2_members.id_project
                AND dz2_projects.number_of_members <= 
                    (SELECT COUNT(*) FROM dz2_members AS mem 
                        WHERE 	dz2_members.id_project = mem.id_project
                        AND 	mem.member_type IN ("member", "application_accepted", "invitation_accepted"))');
            $st->execute(array());
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.allProjects): ' . $e->getMessage());
        }
    }

    public function accept($project_id, $user_id)
    {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('UPDATE dz2_members JOIN dz2_projects
                SET dz2_members.member_type="application_accepted"
                WHERE   dz2_members.id_project=:project_id AND dz2_projects.id=:project_id
                AND     dz2_members.id_user=:user_id
                AND     dz2_members.member_type="invitation_pending"
                AND 	dz2_projects.status="open"');
            $st->execute(array('user_id' => $user_id, 'project_id' => $project_id));
        } catch (PDOException $e) {
            exit('DB error (ProjectsService.allProjects): ' . $e->getMessage());
        }

        $this->correctStatus();
    }
};
