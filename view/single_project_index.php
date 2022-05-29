<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<?php require_once __SITE_PATH . '/view/view_util.php'; ?>

<div class="projectcontainer">
    <div class="card">
        <?php
        print_project_meta($project, $user_map);
        print_project_title($project);
        print_project_description($project);
        print_project_members($project, $user_map, $members);

        if (strcmp($member_type, '') === 0 && strcmp($project['status'], "open") === 0) {
            print_application_button($project['id']);
        } elseif (strcmp($member_type, '') !== 0 && strcmp($member_type, 'member') !== 0) {
            print_membership_type($member_type);
        }
        ?>
    </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>