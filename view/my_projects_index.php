<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<?php require_once __SITE_PATH . '/view/view_util.php'; ?>

<div class="projectcontainer">

<?php

foreach ($my_projects as $project) {
    echo '<div class="card">';

    // echo '<a href="' . __SITE_URL . '/teamup.php?rt=projects/single&id=' . $project['id'] . '"> <span class="clickable"></span> </a>';

    print_project_meta($project, $user_map);
    print_project_title($project);
    // print_invite_form($project);

    if (isset($project_has_applications[$project['id']])) {
        echo '<div class="projectmeta upperspace">';
        echo "Applications";
        echo '</div>';
    }

    foreach ($applications as $application) {
        $project_id = $application[0];
        $user_id = $application[1];
        $user_name = $application[2];
        if (strcmp($project_id, $project['id']) !== 0) {
            continue;
        }

        echo ucfirst($user_name);
        print_spacer();
        print_accrej_button_applications($project_id, $user_id, "accept");
        print_spacer();
        print_accrej_button_applications($project_id, $user_id, "reject");
        echo '<br/>';
    }

    echo "</div>";
}

?>

</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
