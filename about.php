<?php
require("_connection.php");
session_start();
$_SESSION["email_err"] = "";
$_SESSION["password_err"] = "";
$_SESSION["username_err"] = "";
$_SESSION["policies_err"] = "";
$_SESSION["l_email_err"] = "";
$_SESSION["l_password_err"] = "";
if (!isset($_SESSION["date"]))
    $_SESSION["date"] = date('Y-m-d');
?>

<?php
if (isset($_REQUEST["log_in"])) {
    if (isset($_REQUEST["email"]) && !empty($_REQUEST["email"]) && isset($_REQUEST["password"]) && !empty($_REQUEST["password"])) {

        $result = $conn->prepare("select * from users where email = :email and password = md5(:password)");
        $result->bindParam(':email', $_REQUEST["email"]);
        $result->bindParam(':password', $_REQUEST["password"]);
        $result->execute();

        foreach ($result->fetchAll() as $row) {
            $_SESSION["user"] = $row;
        }
    } else {
        if (!isset($_REQUEST["email"]) || empty($_REQUEST["email"])) {
            $_SESSION["email_err"] = "Campo não preenchido";
        }

        if (!isset($_REQUEST["password"]) || empty($_REQUEST["password"])) {
            $_SESSION["password_err"] = "Campo não preenchido";
        }

        if (!isset($_REQUEST["username"]) || empty($_REQUEST["username"])) {
            $_SESSION["username_err"] = "Campo não preenchido";
        }

        if (!isset($_REQUEST["policies"])) {
            $_SESSION["policies_err"] = "Campo não preenchido";
        }
    }
} else if (isset($_REQUEST["sign_up"])) {
    if (
        isset($_REQUEST["email"]) && !empty($_REQUEST["email"]) && isset($_REQUEST["password"]) && !empty($_REQUEST["password"])
        && isset($_REQUEST["username"]) && !empty($_REQUEST["username"]) && isset($_REQUEST["policies"])
    ) {

        $result = $conn->prepare("insert into users values (null,'" . $_REQUEST["username"] . "','" . $_REQUEST["email"] . "',md5('" . $_REQUEST["password"] . "'), default, default, default)");
        $result->execute();

        $result = $conn->prepare("select * from users where email = :email and password = md5(:password)");
        $result->bindParam(':email', $_REQUEST["email"]);
        $result->bindParam(':password', $_REQUEST["password"]);
        $result->execute();

        foreach ($result->fetchAll() as $row) {
            $_SESSION["user"] = $row;
        }
    } else {
        if (!isset($_REQUEST["email"]) || empty($_REQUEST["email"])) {
            $_SESSION["email_err"] = "Campo não preenchido";
        }

        if (!isset($_REQUEST["password"]) || empty($_REQUEST["password"]) || strlen($_REQUEST["username"]) <= 1) {
            $_SESSION["password_err"] = "Campo não preenchido ou muito curto";
        }

        if (!isset($_REQUEST["username"]) || empty($_REQUEST["username"]) || strlen($_REQUEST["username"]) <= 2) {
            $_SESSION["username_err"] = "Campo não preenchido ou muito curto";
        }

        if (!isset($_REQUEST["policies"])) {
            $_SESSION["policies_err"] = "Campo não preenchido";
        }
    }
} else if (isset($_REQUEST["request_technology"]) && isset($_REQUEST["technology"])) {
    if (!empty($_REQUEST["technology"])) {
        $learning = htmlspecialchars($_REQUEST["technology"]);
        $result = $conn->prepare("insert into request_technology values (null, {$_SESSION["user"]["id"]}, '{$learning}', now(),'w');");
        $result->execute();
    }
} else if (isset($_REQUEST["new_technology"])) {
    if (!empty($_REQUEST["technology"])) {

        if (isset($_REQUEST["goal"]))
            $goal = htmlspecialchars($_REQUEST["goal"]);
        else
            $goal = "goal";

        $learning = htmlspecialchars($_REQUEST["technology"]);
        $_SESSION["a"] = $learning;
        $result = $conn->prepare("insert into user_branch values (null, {$_SESSION["user"]["id"]}, (select id from branches where branches.name = '{$learning}'), now(), false, '{$goal}');");
        $result->execute();
    }
} else if (isset($_REQUEST["yes"])) {
    if (isset($_REQUEST["current"]) && !empty($_REQUEST["current"])) {
        $current = htmlspecialchars($_REQUEST["current"]);
        $result = $conn->prepare("insert into today values (null, {$current}, true, now());");
        $result->execute();
    }
} else if (isset($_REQUEST["accept"])) {
    if (isset($_REQUEST["request"]) && !empty($_REQUEST["request"])) {
        $current = htmlspecialchars($_REQUEST["request"]);

        if (isset($_REQUEST["primitive"]) && $_REQUEST["primitive"] != "") {
            $result = $conn->prepare("select * from branches where name = '{$_REQUEST["branch"]}'");
            $result->execute();

            if ($result->rowCount() <= 0) {
                $result = $conn->prepare("insert into branches values (null, {$_REQUEST["primitive"]}, '{$_REQUEST["branch"]}', '-')");
                $result->execute();
            }
        } else {
            $result = $conn->prepare("select * from technologies where name = '{$_REQUEST["branch"]}'");
            $result->execute();

            if ($result->rowCount() <= 0) {
                $result = $conn->prepare("insert into technologies values (null, '{$_REQUEST["branch"]}', now());");
                $result->execute();
            }

            $result = $conn->prepare("update request_technology set situation ='a' where id = {$_REQUEST["request"]};");
            $result->execute();
        }
    }
} else if (isset($_REQUEST["reject"])) {
    if (isset($_REQUEST["request"]) && !empty($_REQUEST["request"])) {

        $result = $conn->prepare("update request_technology set situation ='d' where id = '{$_REQUEST["request"]}';");
        $result->execute();
    }
} else if (isset($_REQUEST["log_out"])) {
    session_destroy();
    $_SESSION = array();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About</title>

    <link rel="stylesheet" href="./sources/css/bootstrap.css">
    <script src="./sources/js/bootstrap.js"></script>

    <link rel="stylesheet" href="./sources/index.css">
    <script src="./sources/index.js"></script>
</head>

<body>

<?php include("./view/header.php"); ?>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="title">About</h1>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    Archangelus.log
                                </div>
                                <div class="col-12">
                                    Archangelus.log is a learning tracking tool, where you can add programming languages, frameworks, etc to your learning list.
                                </div>
                                <div class="col-12">
                                    With Arch you will keep your tracking just by opening the site, click the "yes" button and done!
                                </div>
                                <div class="col-12">
                                    The simplicity with a powerful assistance!
                                </div>
                                <div class="col-12">
                                Did you ever felt a bit lost about wich tecgnologies, languages, frameworks, tools, etc. you ever have learned? Or how boring is to have .txt files or spreadsheet tracking your study?

Meet Archangelus.log, where you can simply login, type yes and quit. Not only this, but you can check the days what you learn. Give it a try!
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    Hi, I'm Jonas Santos Menezes (@domnyus), Brazil.
                                </div>
                                <div class="col-12">
                                    Feel free to contact me!
                                </div>
                                <div class="col-12">
                                    <a href="https://www.linkedin.com/in/jonas-santos-menezes-01104b269/" target="_blank">LinkedIn</a>
                                </div>
                                <div class="col-12">
                                    <a href="https://github.com/Domnyus" target="_blank">Github</a>
                                </div>
                                <div class="col-12">
                                    Writer, Developer, YouTuber and a mortal being.
                                </div>
                                <div class="col-12">
                                    I'm just a simple passionate developer as anyone, so I beg you do not be mean or destroy my dream, beign you a hacker/cracker or a malicious person.
                                </div>
                                <div class="col-12">
                                    <q>...Credo in Spiritum Sanctum, sanctam Ecclesiam catholicam, sanctorum communionem, remissionem peccatorum, carnis resurrectionem, vitam æternam. Amen.</q>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>