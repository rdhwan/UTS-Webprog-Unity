<?php
require_once __DIR__ . "/../bootstrap.php";

if (isset ($_COOKIE["token"]) && $user = User::where("remember_token", "=", $_COOKIE["token"])->first()) {
    $_SESSION["error"] = "You are already signed in.";

    if ($user->role === "admin") {
        header("Location: /src/Public/admin/index.php");
    } else {
        header("Location: /src/Public/nasabah/index.php");
    }
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    function generateToken()
    {
        return bin2hex(random_bytes(32));
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // recaptcha
    $captcha = $_POST['g-recaptcha-response'];
    if (empty ($captcha)) {
        $_SESSION["error"] = "You need to solve the captcha first";
        header("Location: index.php");
        exit;
    }

    $ip = $_SERVER['REMOTE_ADDR'];

    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode(env("RECAPTCHA_SECRET_KEY")) . '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        $_SESSION["error"] = "Captcha verification failed";
        header("Location: index.php");
        exit;
    }

    // validasi
    // check if username and password is empty
    if (empty ($username) || empty ($password)) {
        $_SESSION["error"] = "Username or password is empty";
        header("Location: index.php");
        exit;
    }

    // check password length
    if (strlen($password) < 8) {
        $_SESSION["error"] = "Password must be at least 8 characters";
        header("Location: index.php");
        exit;
    }

    $user = User::where("username", "=", $username)->first();
    if (empty ($user)) {
        $_SESSION["error"] = "Account not found";
        header("Location: index.php");
        exit;
    }

    if (!password_verify($password, $user->password)) {
        $_SESSION["error"] = "Password is incorrect";
        header("Location: index.php");
        exit;
    }

    $token = generateToken();
    $user->remember_token = $token;
    $user->save();

    setcookie("token", $token, time() + 3600 * 24, "/");

    if ($user->role === "admin") {
        header("Location: /src/Public/admin/index.php");
    } else {
        header("Location: /src/Public/nasabah/index.php");
    }
    exit;
}

// get method
$error = $_SESSION["error"] ?? null;
$_SESSION["error"] = null;

?>


<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/output.css">
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <title>Unity Cooperative</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

<body class="flex flex-row justify-end min-h-screen min-w-full font-inter">
    <div class="invisible md:visible flex flex-1 bg-[url('../images/loginBg.png')] bg-no-repeat bg-cover bg-center">
    </div>
    <div class="flex flex-col w-full md:w-[33%] justify-center items-center">
        <img src="./images/logo.png" alt="logo" class="my-[2rem] w-96">
        <form method="post" class="flex flex-1 flex-col align-center gap-4 w-full p-[2rem]">
            <span class="font-light text-[#FF8E8F]">Username</span>
            <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                <i class="ph ph-user opacity-35 text-2xl"></i>
                <input type="username" required name="username" class="w-full bg-transparent"
                    placeholder="Type your username" />
            </label>
            <span class="font-light text-[#FF8E8F]">Password</span>
            <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                <i class="ph ph-lock opacity-35 text-2xl"></i>
                <input type="password" required name="password" class="w-full bg-transparent"
                    placeholder="Type your password" />
            </label>
            <div class="flex flex-col w-full items-center justify-center gap-4">
                <!-- <div class="flex justify-center w-[60%] h-[6rem] bg-red-400 my-[2rem]"></div> -->
                <div class="g-recaptcha" data-sitekey="6LdSWqApAAAAAHSYL46-e65IpvJv2cxiJcuBjjcT"></div>

                <?php if ($error): ?>
                    <p class="text-red-400">
                        <?= $error ?>
                    </p>
                <?php endif; ?>

                <button type="submit"
                    class="flex justify-center items-center w-full h-[4rem] bg-gradient-to-r from-[#E178C5] to-[#FFB38E] rounded-[3rem] text-[#FFFDCB] font-bold text-2xl">Login</button>
                <div class="flex text-sm text-[rgb(175,175,175)]">Already have an account?
                    <a href="./register.php" class="text-[#E178C5] font-bold pl-1">Register</a>
                </div>
            </div>

        </form>
    </div>

</body>

</html>