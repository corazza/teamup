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
            echo '<br />';
            echo '<a class="linkbutton" href="';
            echo __SITE_URL . "/teamup.php?rt=projects/apply&id=" . $project['id'];
            echo '" >apply</a>';
        } elseif (strcmp($member_type, '') !== 0 && strcmp($member_type, 'member') !== 0) {
            echo '<br />';
            echo '<span class="projectmeta">';
            echo prettify_member_type($member_type);
            echo '</span>';
        }
        ?>
    </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>