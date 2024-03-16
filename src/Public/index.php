<?php
require __DIR__ . "/../Middleware/checkAuth.php";

if ($user->role === "admin") {
    header("Location: /src/Public/admin/index.php");
} else {
    header("Location: /src/Public/nasabah/index.php");
}