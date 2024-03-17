<?php

require_once __DIR__ . "/../bootstrap.php";

// delete cookies
setcookie("token", "", time() - 3600, "/");

header("Location: /src/Public/index.php");