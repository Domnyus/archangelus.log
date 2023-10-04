<?php
    include("./_request.php");
?>
<?php
    if(!isset($_SESSION["user"]))
        header("location: index");
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile</title>

    <link rel="stylesheet" href="./sources/css/bootstrap.css">

    <link rel="stylesheet" href="./sources/index.css">
    <script src="./sources/index.js"></script>
</head>

<body>

<?php include("./view/header.php"); ?>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-12">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="title">@<?php echo $_SESSION["user"]["username"]; ?></h1>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <?php include("./view/profile/change.php"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script src="./sources/js/bootstrap.js"></script>
</body>

</html>