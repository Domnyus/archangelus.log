<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="container cards" style="display: none;" id="sign_up" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <a class="col-1 order-2 to_close" onclick="show_('#sign_up')">X</a>
                <a href="#" class="col-11 order-1"></a>
            </div>
            <div class="row">
                <label for="username" class="col-3 card-field">Username:</label>
                <input type="text" name="username" id="username" class="col-9 card-field" minlength="3" required>
                <?php if (isset($_SESSION["username_err"])) echo "<p class='p_err'>{$_SESSION["username_err"]}</p>"; ?>
            </div>
            <div class="row">
                <label for="e-m" class="col-3 card-field">Email:</label>
                <input type="email" name="email" id="e-m" class="col-9 card-field" required>
                <?php if (isset($_SESSION["email_err"])) echo "<p class='p_err'>{$_SESSION["email_err"]}</p>"; ?>
            </div>
            <div class="row">
                <label for="pw" class="col-3 card-field">Password:</label>
                <input type="password" name="password" id="pw" class="col-9 card-field" minlength="8" required>
                <?php if (isset($_SESSION["password_err"])) echo "<p class='p_err'>{$_SESSION["password_err"]}</p>"; ?>
            </div>
            <div class="row">
                <input type="checkbox" name="policies" id="policies" class="col-1" required>
                <label for="policies" class="col-11">Read and Agree with <a href="policies.php" target="_blank">Archangelus.log Policies.</a></label>
                <?php if (isset($_SESSION["policies_err"])) echo "<p class='p_err'>{$_SESSION["policies_err"]}</p>"; ?>
            </div>
            <div class="row">
                <input type="submit" name="sign_up" class="col-12 nav_button" value="Sign up">
            </div>
        </div>
    </div>
</form>