<?php

if (isset($_REQUEST["username_change"])) {
    htmlspecialchars($_REQUEST["new_username"]);

    $err = false;

    if (!isset($_REQUEST["username_change"]) || empty($_REQUEST["username_change"])) {
        $_SESSION["err"]["username"][0] = "Missing username";
        $err = true;
    } else
        $_SESSION["err"]["username"][0] = "";

    if (!$err) {
        $result = $conn->prepare("update users set username = '{$_REQUEST["new_username"]}' where id = {$_SESSION["user"]["id"]}");
        $result->execute();

        $result = $conn->prepare("select * from users where id = {$_SESSION["user"]["id"]}");
        $result->execute();

        $_SESSION["user"] = $result->fetchAll()[0];
    }
} else if (isset($_REQUEST["update_password"])) {
    htmlspecialchars($_REQUEST["current_password"]);
    htmlspecialchars($_REQUEST["new_password"]);
    htmlspecialchars($_REQUEST["confirm_password"]);

    $err = false;

    if (!isset($_REQUEST["current_password"]) || empty($_REQUEST["current_password"])) {
        $_SESSION["err"]["current_password"][0] = "Missing current password";
        $err = true;
    } else
        $_SESSION["err"]["current_password"][0] = "";

    if (!isset($_REQUEST["new_password"]) || empty($_REQUEST["new_password"])) {
        $_SESSION["err"]["new_password"][0] = "Missing new password";
        $err = true;
    } else
        $_SESSION["err"]["new_password"][0] = "";

    if (!isset($_REQUEST["confirm_password"]) || empty($_REQUEST["confirm_password"])) {
        $_SESSION["err"]["confirm_password"][0] = "Missing confirm password";
        $err = true;
    } else
        $_SESSION["err"]["confirm_password"][0] = "";

    $result = $conn->prepare("select * from users where id = {$_SESSION["user"]["id"]} and password = md5('{$_REQUEST["current_password"]}');");
    $result->execute();

    if($result->rowCount() <= 0)
    {
        $_SESSION["err"]["current_password"][0] = "Wrong current password";
        $err = true;
    }
    else
        $_SESSION["err"]["current_password"][0] = "";

    if (!$err) {
        $result = $conn->prepare("update users set password = md5('{$_REQUEST["confirm_password"]}') where id = {$_SESSION["user"]["id"]}");
        $result->execute();
    }
}
?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="container cards" id="update_username" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <label for="new_username" class="col-3 card-field">Username:</label>
                <input type="text" name="new_username" id="new_username" class="col-9 card-field" required minlength="3" maxlength="32" x>
                <p class="p_err"><?php if (isset($_SESSION["err"]["username"][0])) echo $_SESSION["err"]["username"][0]; ?></p>
            </div>
            <div class="row">
                <input type="submit" name="username_change" id="submit" class="col-12 nav_button" value="Update Username">
            </div>
        </div>
    </div>
</form>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="container cards" id="update_password" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <label for="current_password" class="col-3 card-field">Current Password:</label>
                <input type="password" name="current_password" id="current_password" class="col-9 card-field" required minlength="3" maxlength="32">
                <p class="p_err"><?php if (isset($_SESSION["err"]["current_password"][0])) echo $_SESSION["err"]["current_password"][0]; ?></p>
            </div>
            <div class="row">
                <label for="new_password" class="col-3 card-field">New Password:</label>
                <input type="password" name="new_password" id="new_password" class="col-9 card-field" required minlength="3" maxlength="32">
                <p class="p_err"><?php if (isset($_SESSION["err"]["new_password"][0])) echo $_SESSION["err"]["new_password"][0]; ?></p>
            </div>
            <div class="row">
                <label for="confirm_password" class="col-3 card-field">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="col-9 card-field" required minlength="3" maxlength="32">
                <p class="p_err"><?php if (isset($_SESSION["err"]["confirm_password"][0])) echo $_SESSION["err"]["confirm_password"][0]; ?></p>
            </div>
            <div class="row">
                <input type="submit" name="update_password" id="submit" class="col-12 nav_button" value="Update Password">
            </div>
        </div>
    </div>
</form>