<?php
require_once __DIR__ . "/../../Middleware/checkAdmin.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newPassword = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($newPassword === $confirmPassword) {
        if (strlen($newPassword) >= 8 && preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $newPassword)) {
            $token = $_COOKIE["token"];
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $user->password = $hashedPassword;
            $user->save();
            $_SESSION["success"] = "Password changed successfully!";
            header("Location: reset-password.php");
            exit;
        } else {
            $_SESSION["error"] = "Password must contain at least 8 characters, including uppercase letters and numbers.";
            header("Location: reset-password.php");
            exit;
        }
    } else {
        $_SESSION["error"] = "Passwords don't match or are empty.";
        header("Location: reset-password.php");
        exit;
    }
}

$error = $_SESSION["error"] ?? null;
$success = $_SESSION["success"] ?? null;

$_SESSION["error"] = null;
$_SESSION["success"] = null;

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <title>Unity</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="flex flex-col min-h-screen min-w-full font-inter p-4 md:p-8">
    <!-- navbar -->
    <div class="flex flex-row items-center justify-between gap-8">

        <details class="visible md:hidden dropdown">
            <summary class="btn btn-ghost text-[#E178C5]">
                <i class="ph ph-list text-4xl"></i>
            </summary>
            <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                <li>
                    <a href="./users/index.php"
                        class="btn btn-ghost flex items-center justify-start font-semibold text-lg text-[#E178C5]">Users
                    </a>
                </li>
                <li>
                    <a href="./history/index.php"
                        class="btn btn-ghost flex items-center justify-start font-semibold text-lg text-[#E178C5]">History
                    </a>
                </li>
            </ul>
        </details>



        <div class="hidden md:flex flex-row items-center gap-8">
            <a href="/admin/index.php">
                <img src="../images/logo.png" class="w-36 md:w-24" />
            </a>

            <a href="./users/index.php" class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">Users</a>
            <a href="./history/index.php"
                class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">History</a>

        </div>

        <details class="dropdown dropdown-end">
            <summary class="btn btn-link no-underline hover:no-underline">
                <div class="hidden md:flex flex-col items-start">
                    <p class="font-semibold text-[#E178C5]">
                        <?= $user["nama"] ?>
                    </p>
                    <p class="font-light text-[#E178C5]/50">Admin</p>
                </div>
                <?php if (!empty ($user["profile_picture"])): ?>
                <img src="../images/profile/<?= $user["profile_picture"] ?>" class="w-14 md:w-11 rounded-full" />
                <?php else: ?>
                <img src="../images/profile/dummyProfile.svg" class="w-14 md:w-11 rounded-full" />
                <?php endif; ?>
            </summary>
            <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                <div class="flex md:hidden flex-col p-4">
                    <p class="font-semibold text-[#E178C5]">
                        <?= $user["nama"] ?>
                    </p>
                    <p class="font-light text-[#E178C5]/50">Admin</p>

                    <hr class="my-2 border-[#E178C5] w-full" />
                </div>

                <li>
                    <div class="text-[#E178C5] text-base">
                        <p class="ph ph-pencil-simple-line text-xl"></p>
                        <a href="./profile.php">Edit profile</a>
                    </div>
                </li>
                <li>
                    <div class="text-[#FF8E8F] text-base">
                        <p class="ph ph-sign-out text-xl"></p>
                        <a href="./logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </details>

    </div>



    <!-- content -->
    <div class="flex flex-1 h-full my-4 justify-center items-center">
        <div
            class="mb-[3rem] md:mb-0 flex flex-col relative bg-gradient-to-r from-[#E178C5] to-[#FFB38E] p-5 w-[30rem] h-auto rounded-2xl shadow-lg">
            <div class="bg-[#f6f6f6] rounded-xl md:p-[2rem] p-[1rem]">
                <div class="flex justify-between">
                    <span class="md:text-3xl text-xl font-bold text-[#FF8E8F]">
                        Reset Password
                    </span>
                    <a href="profile.php" class="flex-column justify-center mb-5 items-center ">
                        <i class="mb-1 flex justify-center ph-bold ph-x text-center  text-[#1F1F1F]/35"></i>
                        <p class="text-sm text-[#FF8E8F] font-bold hidden sm:block">ESC</p>
                    </a>
                </div>
                <form action="reset-password.php" method="POST" class="mb-5">
                    <div class="my-5">
                        <span class="font-light text-[#FF8E8F]">New Password</span>
                        <label class="my-5 flex flex-row bg-transparent rounded-none border-b-2 pb-2 w-full">
                            <i class="ph ph-lock opacity-35 text-2xl me-3"></i>
                            <input type="password" required name="password" class="w-full bg-transparent"
                                placeholder="Type new password" />
                        </label>
                    </div>
                    <div class="my-5">
                        <span class="font-light text-[#FF8E8F]">Confirm Password</span>
                        <label class="my-5 flex flex-row bg-transparent rounded-none border-b-2 pb-2 w-full">
                            <i class="ph ph-lock opacity-35 text-2xl me-3"></i>
                            <input type="password" required name="confirm_password" class="w-full bg-transparent"
                                placeholder="Confirm new password" />
                        </label>
                    </div>
                    <?php if (isset ($error) && $error): ?>
                    <p class="text-red-400">
                        <?= $error ?>
                    </p>
                    <?php endif; ?>
                    <?php if (isset ($success) && $success): ?>
                    <p class="text-green-400">
                        <?= $success ?>
                    </p>
                    <?php endif; ?>
                    <button type="submit"
                        class="mt-5 flex justify-center items-center w-[10rem] h-[2rem] p-3 bg-[#FF8E8F] rounded-[0.5rem] text-[#FFFDCB] font-bold text-sm shadow-lg">
                        Change Password
                    </button>
                </form>
            </div>
        </div>
    </div>


    <footer
        class="footer footer-center items-center justify-center text-white font-semibold bg-[url('../images/background/bottom.svg')] fixed inset-x-0 bottom-0">
        <p class="text-center z-10 p-4">©2024 Unity. All rights reserved.</p>
    </footer>

</body>

</html>