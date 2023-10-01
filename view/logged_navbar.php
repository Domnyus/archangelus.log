<div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <form action='<?php echo "profile.php"; ?>' method="post" enctype="multipart/form-data">
                <input type="submit" value="Profile" name="to_profile" class="nav_button">
            </form>
        </li>
        <li class="nav-item">
            <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="post" enctype="multipart/form-data">
                <input type="submit" value="Log Out" name="log_out" class="nav_button">
            </form>
        </li>
    </ul>
</div>