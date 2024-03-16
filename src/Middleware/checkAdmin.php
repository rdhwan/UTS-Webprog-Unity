<?php

require_once __DIR__ . "/../Middleware/checkAuth.php";

if ($user->role !== "admin") {
    $_SESSION["error"] = "You are not authorized to access this page";

    header("Location: /src/Public/admin/index.php");
    exit;
}