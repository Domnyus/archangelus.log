<?php
session_start();
    if (isset($_SESSION["date"]))
    {
        $next = date('Y-m', strtotime("{$_SESSION["date"]} first day of -1 month"));
        $_SESSION["date"] = $next;
    }
    header("location: index.php");