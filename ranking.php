<?php
include("./_request.php");
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rankings</title>

    <link rel="stylesheet" href="./sources/css/bootstrap.css">

    <link rel="stylesheet" href="./sources/index.css">
</head>

<body>

    <?php include("./view/header.php"); ?>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3">
                    <div class="row">

                        <div class="col-12">
                            <h1 class="title">Rankings</h1>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    Here's the rankings of commitment.
                                </div>
                                <div class="col-12">
                                    There are three different rankings:
                                </div>
                                <div class="col-12">
                                    <ol>
                                        <li>Aeternum: ranking of all time.</li>
                                        <li>Legenda: ranking of this year.</li>
                                        <li>Magnus: ranking of this month.</li>
                                    </ol>
                                </div>
                                <div class="col-12">
                                    This is purely for inspiration, because I think people can two-time themselves just by clicking on "yes" randomly. But I believe in honesty of few!
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12">
                                    <h5 class="title">Magnus</h5>
                                </div>

                                <div class="col-12">
                                    <ol>
                                        <?php
                                        try {
                                            $result = $conn->prepare("select distinct(users.username), count(day(today.day)) as times from users join user_branch on user_branch.user = users.id inner join today on today.user_branch = user_branch.id where month(current_timestamp())-month(today.day) < 1 group by users.id order by times desc limit 10;");
                                            $result->execute();

                                            foreach ($result->fetchAll() as $row) {
                                                echo "<li>
                                                <div class=\"row\">
                                                    <div class=\"col-4\">The user @{$row["username"]}</div>
                                                    <div class=\"col-8\">has learn/practiced something <span class=\"times\">{$row["times"]}</span> times this month.</div>
                                                    </div>
                                                </li>";
                                            }
                                        } catch (Exception $e) {
                                            header("location: index.php");
                                        }
                                        ?>

                                    </ol>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="title">Legenda</h5>
                                </div>
                                <div class="col-12">
                                    <ol>
                                        <?php
                                        try {
                                            $result = $conn->prepare("select distinct(users.username), count(day(today.day)) as times from users join user_branch on user_branch.user = users.id inner join today on today.user_branch = user_branch.id where year(current_timestamp())-year(today.day) < 1 group by users.id order by times desc limit 10;");
                                            $result->execute();

                                            foreach ($result->fetchAll() as $row) {
                                                echo "<li>
                                                        <div class=\"row\">
                                                            <div class=\"col-4\">The user @{$row["username"]}</div>
                                                            <div class=\"col-8\">has learn/practiced something <span class=\"times\">{$row["times"]}</span> times this year.</div>
                                                        </div>
                                                    </li>";
                                            }
                                        } catch (Exception $e) {
                                            header("location: index.php");
                                        }
                                        ?>

                                    </ol>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="title">Aeternum</h5>
                                </div>
                                <div class="col-12">
                                    <ol>
                                        <?php
                                        try {
                                            $result = $conn->prepare("select distinct(users.username), count(day(today.day)) as times from users join user_branch on user_branch.user = users.id inner join today on today.user_branch = user_branch.id group by users.id order by times desc limit 10;");
                                            $result->execute();

                                            foreach ($result->fetchAll() as $row) {
                                                echo "<li>
                                                <div class=\"row\">
                                                    <div class=\"col-4\">The user @{$row["username"]}</div>
                                                    <div class=\"col-8\">has learn/practiced something <span class=\"times\">{$row["times"]}</span> times since joined.</div>
                                                    </div>
                                                </li>";
                                            }
                                        } catch (Exception $e) {
                                            header("location: index.php");
                                        }
                                        ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="./sources/js/bootstrap.js"></script>
    <script src="./sources/index.js"></script>
</body>

</html>