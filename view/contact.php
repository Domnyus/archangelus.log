<?php
if (isset($_REQUEST["contact"])) {
    htmlspecialchars($_REQUEST["subject"]);
    htmlspecialchars($_REQUEST["content"]);

    $err = false;

    if (!isset($_REQUEST["subject"]) || empty($_REQUEST["subject"])) {
        $_SESSION["err"]["contact"][0] = "Missing subject";
        $err = true;
    } else
        $_SESSION["err"]["contact"][0] = "";

    if (!isset($_REQUEST["content"]) || empty($_REQUEST["content"])) {
        $_SESSION["err"]["contact"][1] = "Missing content";
        $err = true;
    } else
        $_SESSION["err"]["contact"][1] = "";

    if (!$err) {
        $result = $conn->prepare("insert into contact values (null, '{$_REQUEST["subject"]}', '{$_REQUEST["content"]}', now());");
        $result->execute();
    }
}
?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="container cards" id="contact" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <label for="s" class="col-3 card-field">Subject:</label>
                <input type="text" name="subject" id="s" class="col-9 card-field" required minlength="1">
                <p class="p_err"><?php if (isset($_SESSION["err"]["contact"][0])) echo $_SESSION["err"]["contact"][0]; ?></p>
            </div>
            <div class="row">
                <label for="c" class="col-3 card-field">Content:</label>
                <textarea name="content" id="c" cols="30" rows="10" class="col-12" required minlength="1" maxlength="255"></textarea>
                <p class="p_err"><?php if (isset($_SESSION["err"]["contact"][1])) echo $_SESSION["err"]["contact"][1]; ?></p>
            </div>
            <div class="row">
                <input type="submit" name="contact" id="submit" class="col-12 nav_button" value="Send">
            </div>
        </div>
    </div>
</form>