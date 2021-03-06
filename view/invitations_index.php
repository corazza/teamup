<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<?php require_once __SITE_PATH . '/view/view_util.php'; ?>

<div class="projectcontainer">

<?php
foreach ($all_projects_invited as $project) {
    echo '<div class="card textcontent">';

    // echo '<a href="' . __SITE_URL . '/teamup.php?rt=projects/single&id=' . $project['id'] . '"> <span class="clickable"></span> </a>';

    print_project_meta($project, $user_map);
    print_project_title($project);
    print_appinv_type($project['member_type']);

    if (strcmp($project['member_type'], "invitation_pending") === 0) {
        echo '<br/>';
        echo '<br/>';
    
        print_accrej_button($project['id'], 'accept');
        print_spacer();
        print_accrej_button($project['id'], 'reject');
    }

    echo "</div>";
}

if (count($all_projects_invited) === 0) {
    echo "You have no pending project invitations";
}

?>

</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
