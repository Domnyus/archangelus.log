<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="container cards" style="display: none;" id="log_in" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <a class="col-1 order-2 to_close" onclick="show_('#log_in')">X</a>
                <a href="#" class="col-11 order-1"></a>
            </div>
            <div class="row">
                <label for="e" class="col-3 card-field">Email:</label>
                <input type="email" name="email" id="e" class="col-9 card-field" required>
                <?php if(isset($_SESSION["l_email_err"])) echo "<p class='p_err'>{$_SESSION["l_email_err"]}</p>"; ?>
            </div>
            <div class="row">
                <label for="p" class="col-3 card-field">Password:</label>
                <input type="password" name="password" id='p' class="col-9 card-field" minlength="8" required>
                <?php if(isset($_SESSION["l_password_err"])) echo "<p class='p_err'>{$_SESSION["l_password_err"]}</p>"; ?>
            </div>
            <div class="row">
                <input type="submit" name="log_in" id="submit" class="col-12 nav_button" value="Log In">
            </div>
        </div>
    </div>
</form>