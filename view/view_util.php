<?php

function print_project_meta($project, $user_map) {
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
}

function print_project_title($project) {
    echo '<div class="projecttitle">';
    echo $project['title'];
    echo "</div>";
}

function print_project_description($project) {
    echo '<div class="projectmeta upperspace">';
    echo "Description";
    echo '</div>';
    echo '<div>';
    echo $project['abstract'];
    echo '</div>';
}

function print_project_members($project, $user_map) {
    echo '<div class="projectmeta upperspace">';
    echo "Description";
    echo '</div>';
    echo '<div>';
    echo $project['abstract'];
    echo '</div>';
}

?>
