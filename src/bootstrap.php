<?php
require_once __DIR__ . "/../vendor/autoload.php";
session_start();

use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$capsule = new Capsule;

$capsule->addConnection([
    "driver" => env("DB_CONNECTION", "mysql"),
    "host" => env("DB_HOST", "127.0.0.1"),
    "database" => env("DB_DATABASE", "unitybook"),
    "username" => env("DB_USERNAME", "root"),
    "password" => env("DB_PASSWORD", ""),
    "charset" => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix" => "",
]);


$capsule->setAsGlobal();
$capsule->bootEloquent();