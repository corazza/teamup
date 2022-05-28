<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div class="projectcontainer">

<?php

foreach ($all_projects as $project) {
    echo '<div class="card">';

    echo '<div class="projectmeta">';
    echo "Autor: ";
    echo ucfirst($user_map[$project['id_user']]['username']);
    echo " (status: ";
    if (strcmp($project['status'], "open") === 0) {
        echo '<span class="statustext projectopen">';
    } else {
        echo '<span class="statustext projectclosed">';
    }
    echo $project['status'];
    echo '</span>';
    echo ")";
    echo '</div>';

    echo '<div class="projecttitle">';
    echo $project['title'];
    echo "</div>";

    echo "</div>";
}

?>

</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
