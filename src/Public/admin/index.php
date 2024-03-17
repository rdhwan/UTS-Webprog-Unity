<?php

require_once __DIR__ . "/../../Middleware/checkAdmin.php";

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
                    <a href="./verification.php"
                        class="btn btn-ghost flex items-center justify-start font-semibold text-lg text-[#E178C5]">Verification
                    </a>
                </li>
                <li>
                    <a href="./history.php"
                        class="btn btn-ghost flex items-center justify-start font-semibold text-lg text-[#E178C5]">History
                    </a>
                </li>
                <li>
                    <a href="./users.php"
                        class="btn btn-ghost flex items-center justify-start font-semibold text-lg text-[#E178C5]">Users
                    </a>
                </li>
            </ul>
        </details>



        <div class="hidden md:flex flex-row items-center gap-8">
            <a href="/src/Public/nasabah/index.php">
                <img src="../images/logo.png" class="w-36 md:w-24" />
            </a>

            <a href="./verification.php"
                class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">Verification</a>
            <a href="./history.php" class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">History</a>
            <a href="./users.php" class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">Users</a>

        </div>

        <details class="dropdown dropdown-end">
            <summary class="btn btn-link no-underline hover:no-underline">
                <img src="../images/profile/dummyProfile.svg" class="w-14 md:w-11" />
                <div class="hidden md:flex flex-col items-start">
                    <p class="font-semibold text-[#E178C5]">
                        <?= $user["nama"] ?>
                    </p>
                    <p class="font-light text-[#E178C5]/50">Admin</p>
                </div>
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
                    <div>
                        <p class="ph ph-pencil-simple-line text-xl"></p>
                        <a href="./profile.php">Edit profile</a>
                    </div>
                </li>
                <li>
                    <div class="text-[#FF8E8F]">
                        <p class="ph ph-sign-out text-xl"></p>
                        <a href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </details>

    </div>



    <!-- content -->
    <div class="flex flex-1 h-full my-4">
        <p>bejier</p>
    </div>


    <footer
        class="footer footer-center items-center justify-center text-white font-semibold bg-[url('../images/background/bottom.svg')] fixed inset-x-0 bottom-0">
        <p class="text-center z-10 p-4">©2024 UnityBook. All rights reserved.</p>
    </footer>

</body>

</html>