<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<?php require_once __SITE_PATH . '/app/util.php' ?>

<br />

<form method="post" action="<?php echo __SITE_URL . '/teamup.php?rt=login/attempt' ?>">
    <ul class="form-style-1">
        <li>
            <label>username</label>
            <input type="text" name="username" class="field-long" />
        </li>
        <li>
            <label>password</label>
            <input type="password" name="password" class="field-long" />
        </li>

        <li>
            <input class="linkbutton" type="submit" value="login" />
        </li>
    </ul>
</form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>