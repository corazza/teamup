<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<?php require_once __SITE_PATH . '/view/view_util.php'; ?>

<div class="projectcontainer">
    <div class="card">
        <?php print_project_meta($project, $user_map) ?>
        <?php print_project_title($project) ?>
        <?php print_project_description($project) ?>
        <?php print_project_members($project, $user_map, $members) ?>
    </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>