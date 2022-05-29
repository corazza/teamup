<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<?php require_once __SITE_PATH . '/view/view_util.php'; ?>

<div class="projectcontainer">

<form method="post" action="<?php echo __SITE_URL . '/teamup.php?rt=projects/start' ?>">
    <ul class="form-style-1">
        <li>
            <label>Name</label>
            <input type="text" name="name" class="field-long" />
        </li>
        <li>
            <label>Description</label>
            <input type="textarea" name="description" class="field-long" />
        </li>
        <li>
            <label>Max. members</label>
            <input type="text" name="members" class="field-long" />
        </li>

        <li>
            <input class="linkbutton" type="submit" value="Start" />
        </li>
    </ul>
</form>

</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
