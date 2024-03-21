<?php
require_once __DIR__ . "/../bootstrap.php";

if (isset ($_COOKIE["token"]) && $user = User::where("remember_token", "=", $_COOKIE["token"])->first()) {
    $_SESSION["error"] = "You are already signed in.";

    if ($user->role === "admin") {
        header("Location: UTSlec/UTS-Webprog-Unity/src/Public/admin/index.php");
    } else {
        header("Location: UTSlec/UTS-Webprog-Unity/src/Public/nasabah/index.php");
    }
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $payment = $_FILES['payment'];

    // recaptcha
    $captcha = $_POST['g-recaptcha-response'];
    if (empty ($captcha)) {
        $_SESSION["error"] = "You need to solve the captcha first";
        header("Location: register.php");
        exit;
    }

    $ip = $_SERVER['REMOTE_ADDR'];

    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode(env("RECAPTCHA_SECRET_KEY")) . '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        $_SESSION["error"] = "Captcha verification failed";
        header("Location: register.php");
        exit;
    }


    if (empty ($fullname) || empty ($username) || empty ($password) || empty ($email) || empty ($address) || empty ($gender) || empty ($birthdate) || empty ($payment)) {
        $_SESSION['error'] = 'There is an empty field';
        header("Location: register.php");
        exit;
    }

    // if (!preg_match("/(^[A-Za-z]{3,16})([ ]{0,1})([A-Za-z]{3,16})?([ ]{0,1})?([A-Za-z]{3,16})?([ ]{0,1})?([A-Za-z]{3,16})/", $fullname)) {
    //     $_SESSION["error"] = "Invalid full name.";
    //     header("Location: register.php");
    //     exit;
    // }


    if (strlen($username) < 3 || strlen($username) > 16) {
        $_SESSION["error"] = "Invalid username. ";
        header("Location: register.php");
        exit;
    }

    if (strlen($password) < 8 || !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
        $_SESSION["error"] = "Password must contain at least 8 characters, must including uppercase and numbers.";
        header("Location: register.php");
        exit;
    }

    if (!preg_match("/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
        $_SESSION["error"] = "Invalid email.";
        header("Location: register.php");
        exit;
    }

    $year = explode("-", $birthdate)[0];
    if ($year < 1945) {
        $_SESSION["error"] = "Birth date must be above 1945.";
        header("Location: register.php");
        exit;
    }

    if ($payment["error"] !== 0) {
        $_SESSION["error"] = "Invalid file.";
        header("Location: register.php");
        exit;
    }

    $allowedMimeType = ["image/png", "image/jpeg", "image/jpg"];
    if (!in_array($payment["type"], $allowedMimeType)) {
        $_SESSION["error"] = "Invalid file type.";
        header("Location: register.php");
        exit;
    }

    // check user
    $user = User::where("username", "=", $username)->orWhere("email", "=", $email)->first();
    if (!empty ($user)) {
        $_SESSION["error"] = "Username or email already exists.";
        header("Location: register.php");
        exit;
    }

    $extension = pathinfo($payment["name"], PATHINFO_EXTENSION);
    $filename = $username . "-" . "pokok" . "." . $extension;
    $path = __DIR__ . "/images/bukti/" . $filename;

    if (!move_uploaded_file($payment["tmp_name"], $path)) {
        $_SESSION["error"] = "Failed to upload file.";
        header("Location: register.php");
        exit;
    }

    // create user
    $user = User::create([
        "is_active" => false,
        "nama" => $fullname,
        "username" => $username,
        "password" => password_hash($password, PASSWORD_BCRYPT),
        "email" => $email,
        "alamat" => $address,
        "jenis_kelamin" => $gender,
        "tanggal_lahir" => $birthdate,
        "role" => "nasabah",
    ]);

    // create history pokok
    $user->histories()->create([
        "jenis" => "pokok",
        "jumlah" => 1000000,
        "bukti" => $filename,
        "status" => "reviewed",
        "tanggal" => date("Y-m-d H:i:s")
    ]);

    $_SESSION["success"] = "Account has been created.";
    header("Location: index.php");
    exit;
}

$error = $_SESSION["error"];
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
    <div class="invisible lg:visible flex flex-1 bg-[url('../images/loginBg.png')] bg-no-repeat bg-cover bg-center">
    </div>
    <form method="post" enctype="multipart/form-data" class="flex flex-col w-full lg:w-[60%] items-center">
        <div class="flex flex-col justify-center items-center lg:items-start w-full pt-[2rem] pl-[2rem]">
            <img src="./images/logo.png" alt="logo" class="w-32 items-center justify-center">
        </div>
        <div class="flex flex-col w-[60%] items-center justify-center">
            <div class="flex text-md font-bold text-center text-2xl text-[#E178C5]">
                Create an Account
            </div>
            <div class="flex text-sm text-[rgb(175,175,175)]">Register yourself today!</div>
        </div>
        <div class="flex flex-col lg:flex-row items-center justify center w-full">
            <div class="flex flex-1 flex-col align-center justify-center gap-4 w-full p-[2rem]">
                <span class="font-light text-[#FF8E8F]">Full Name</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-user opacity-35 text-2xl"></i>
                    <input type="text" required name="fullname" class="w-full bg-transparent"
                        placeholder="Type your full name" />
                </label>
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
                <span class="font-light text-[#FF8E8F]">Email</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-at opacity-35 text-2xl"></i>
                    <input required type="email" name="email" class="w-full bg-transparent"
                        placeholder="Type your email" />
                </label>
            </div>
            <div class="flex flex-1 flex-col align-center justify-center gap-4 w-full p-[2rem]">
                <span class="font-light text-[#FF8E8F]">Address</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-map-pin opacity-35 text-2xl"></i>
                    <input required type="text" name="address" class="w-full bg-transparent"
                        placeholder="Type your address" />
                </label>
                <span class="font-light text-[#FF8E8F]">Gender</span>
                <label class="flex flex-row bg-transparent rounded-none w-full">
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <input type="radio" name="gender" value="L" class="radio checked:bg-[rgb(175,175,175)]" />
                            <span class="label-text text-[rgb(175,175,175)] ml-[1rem]">Male</span>
                        </label>
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <input type="radio" name="gender" value="P"
                                class="radio checked:bg-[rgb(175,175,175)] ml-[1rem]" checked />
                            <span class="label-text text-[rgb(175,175,175)] ml-[1rem]">Female</span>
                        </label>
                    </div>
                </label>
                <span class="font-light text-[#FF8E8F]">Date of Birth</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-calendar opacity-35 text-2xl"></i>
                    <input required type="date" name="birthdate" class="w-full bg-transparent text-[rgb(175,175,175)]"
                        placeholder="Enter your birthdate" />
                </label>
                <span class="font-light text-[#FF8E8F]">Upload Payment Proof</span>
                <label class="flex flex-row items-center bg-transparent rounded-none w-full">
                    <i class="ph ph-file-arrow-up opacity-35 text-2xl"></i>
                    <input required type="file" name="payment"
                        class="file-input file-input-sm file-input-ghost text-[rgb(175,175,175)]" />
                </label>
            </div>

        </div>
        <div class="flex flex-col w-full items-center justify-center gap-4">
            <div class="g-recaptcha" data-sitekey="6LdSWqApAAAAAHSYL46-e65IpvJv2cxiJcuBjjcT"></div>

            <?php if ($error): ?>
                <p class="text-red-400">
                    <?= $error ?>
                </p>
            <?php endif; ?>
            <button
                class="flex justify-center items-center h-[4rem] bg-gradient-to-r from-[#E178C5] to-[#FFB38E] rounded-[3rem] text-[#FFFDCB] font-bold text-3xl px-[4rem]">Register</button>
            <div class="flex text-sm text-[rgb(175,175,175)]">Already have an account? <a href="./index.php"
                    class="text-[#E178C5] font-bold pl-1"> Login</a>
            </div>
        </div>
    </form>

</body>

</html>