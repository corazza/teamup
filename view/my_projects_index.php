<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<?php require_once __SITE_PATH . '/view/view_util.php'; ?>

<div class="projectcontainer">

<?php

foreach ($my_projects as $project) {
    echo '<div class="card">';

    echo '<a href="' . __SITE_URL . '/teamup.php?rt=projects/single&id=' . $project['id'] . '"> <span class="clickable"></span> </a>';

    print_project_meta($project, $user_map);
    print_project_title($project);

    echo "</div>";
}

?>

</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
