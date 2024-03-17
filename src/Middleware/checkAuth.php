<?php
require_once "../../bootstrap.php";

// get cookie
if (!isset ($_COOKIE["token"])) {
    $_SESSION["error"] = "You are not authorized to access this page";

    header("Location: /src/Public/index.php");
    exit;
}

$user = User::where("remember_token", "=", $_COOKIE["token"])->first();

if (!$user) {
    $_SESSION["error"] = "Auth token is invalid or expired. Please sign in again.";

    // delete cookie
    setcookie("token", "", time() - 3600, "/");

    header("Location: /src/Public/index.php");
    exit;
}