<header class="sticky-top">
    <nav class="navbar navbar-expand-md navbar-dark sticky-top" id="menu">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Archangelus.log</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Archangelus.log">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="about.php" class="nav-item menu_item">About</a>
            <a href="feed.php" class="nav-item menu_item">Feed</a>
            <a href="ranking.php" class="nav-item menu_item">Ranking</a>
            <a href="donation.php" class="nav-item menu_item">Donation</a>
            <?php
            if (!isset($_SESSION["user"]["id"]))
                include("./view/not_logged_navbar.html");
            else
                include("./view/logged_navbar.php");
            ?>
        </div>
    </nav>
</header>