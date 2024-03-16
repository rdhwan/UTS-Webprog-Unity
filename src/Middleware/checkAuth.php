<?php
require_once "../../bootstrap.php";

// get cookie
if (!isset ($_COOKIE["auth"])) {
    $_SESSION["error"] = "You are not authorized to access this page";

    header("Location: /src/Public/auth/signin.php");
    exit;
}

$user = User::where("remember_token", "=", $_COOKIE["auth"])->first();

if (!$user) {
    $_SESSION["error"] = "Auth token is invalid or expired. Please sign in again.";

    // delete cookie
    setcookie("auth", "", time() - 3600, "/");

    header("Location: /src/Public/auth/signin.php");
    exit;
}