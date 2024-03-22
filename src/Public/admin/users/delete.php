<?php
require_once __DIR__ . "/../../../Middleware/checkAdmin.php";

$id = $_GET["id"];

$nasabah = User::find($id);
if ($nasabah === null) {
    header("Location: index.php");
    exit;
}

$nasabah->histories()->delete();
$nasabah->delete();

header("Location: index.php");