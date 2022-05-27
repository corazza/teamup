<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<?php require_once __SITE_PATH . '/app/util.php' ?>

<form method="post" action="<?php echo __SITE_URL . '/teamup.php?rt=login/attempt' ?>">
    <label for="name">Username:</label>
    <input type="text" name="username" id="username"></input>
    <label for="name">Password:</label>
    <input type="password" name="password" id="password"></input>
    <button type="submit">Login</button>
</form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
