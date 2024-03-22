<!-- jun: slice user verif -->

<?php

require_once __DIR__ . "/../../../Middleware/checkAdmin.php";

$id = $_GET["id"];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nasabah = User::find($id);
    if ($nasabah === null) {
        header("Location: index.php");
        exit;
    }

    $nasabah->update(["is_active" => !$nasabah["is_active"]]);
    $nasabah->histories()->where("kategori", "=", "pokok")->update(["status" => $nasabah["is_active"] ? "verified" : "reviewed"]);

    header("Location: verification.php?id=$id");
}


$nasabah = User::find($id);
if ($nasabah === null) {
    header("Location: index.php");
    exit;
}

$pokok = $nasabah->histories()->where("kategori", "=", "pokok")->first();

?>


<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/output.css">
    <link rel="shortcut icon" href="../../images/logo.png" type="image/x-icon">
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
                    <a href="../users/index.php"
                        class="btn btn-ghost flex items-center justify-start font-semibold text-lg text-[#E178C5]">Users
                    </a>
                </li>
                <li>
                    <a href="../history/index.php"
                        class="btn btn-ghost flex items-center justify-start font-semibold text-lg text-[#E178C5]">History
                    </a>
                </li>
            </ul>
        </details>



        <div class="hidden md:flex flex-row items-center gap-8">
            <a href="/src/Public/admin/index.php">
                <img src="../../images/logo.png" class="w-36 md:w-24" />
            </a>

            <a href="../users/index.php"
                class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">Users</a>
            <a href="../history/index.php"
                class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">History</a>

        </div>

        <details class="dropdown dropdown-end">
            <summary class="btn btn-link no-underline hover:no-underline">
                <?php if (!empty ($user["profile_picture"])): ?>
                <img src="../../images/profile/<?= $user["profile_picture"] ?>" class="w-14 md:w-11 rounded-full" />
                <?php else: ?>
                <img src="../../images/profile/dummyProfile.svg" class="w-14 md:w-11 rounded-full" />
                <?php endif; ?>
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
                    <div class="text-[#E178C5] text-base">
                        <p class="ph ph-pencil-simple-line text-xl"></p>
                        <a href="../profile.php">Edit profile</a>
                    </div>
                </li>
                <li>
                    <div class="text-[#FF8E8F] text-base">
                        <p class="ph ph-sign-out text-xl"></p>
                        <a href="../../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </details>

    </div>



    <!-- content -->
    <div class="flex flex-1 h-full my-4 justify-center items-center">
        <div
            class="mb-[3rem] md:mb-0 flex flex-col relative bg-gradient-to-r from-[#E178C5] to-[#FFB38E] p-5 md:w-[40rem] w-[18rem] h-auto rounded-2xl shadow-lg">
            <div class="bg-[#f6f6f6] rounded-xl md:p-[2rem] p-[1rem]">
                <div class="flex justify-between">
                    <span class="text-3xl font-bold text-[#FF8E8F]">
                        User Verification
                    </span>
                    <a href="index.php" class="flex-column justify-center mb-5 items-center ">
                        <i class="mb-1 flex justify-center ph-bold ph-x text-center  text-[#1F1F1F]/35"></i>
                        <p class="text-sm text-[#FF8E8F] font-bold hidden sm:block">ESC</p>
                    </a>
                </div>
                <div class="md:flex flex-column md:justify-between">
                    <div class="flex">
                        <?php if (!empty ($nasabah["profile_picture"])): ?>
                        <img src="../../images/profile/<?= $nasabah["profile_picture"] ?>"
                            class="w-20 h-20 object-cover mr-5 rounded-full" />
                        <?php else: ?>
                        <img src="../../images/profile/dummyProfile.svg"
                            class="w-20 h-20 object-cover mr-5 rounded-full" />
                        <?php endif; ?>
                        <div class="flex items-center">
                            <div class="md:flex flex-col items-start text-lg">
                                <p class="font-semibold text-[#E178C5]">
                                    <?= $nasabah["nama"] ?>
                                </p>
                                <p class="font-light text-[#E178C5]/50">Nasabah</p>
                            </div>
                        </div>

                    </div>
                    <div class="flex flex-col justify-content-end items-center">
                        <p class="text-[#FF8E8F]">Status</p>

                        <form name="activeToggle" method="post">
                            <input type="checkbox" class="toggle toggle-success"
                                <?php if ($nasabah["is_active"]) echo "checked" ?>
                                onchange="document.activeToggle.submit()" />
                        </form>
                    </div>

                </div>
                <hr class="my-2 border-[#FF8E8F] w-full mt-5" />
                <div class="md:flex flex-column ">
                    <div class="flex flex-col w-full">
                        <p class="text-[#E178C5] mt-5 font-bold">Payment Proof</p>
                        <p class="text-[#FF8E8F]">Download Image to View</p>
                        <div class="flex mt-3 items-center">
                            <i class="ph ph-download-simple opacity-35 text-2xl"></i>
                            <a href="../../images/bukti/<?= $pokok["bukti"] ?>" target="_blank"
                                class="shadow-lg mt-1 ms-2 flex px-2 py-1 justify-center items-center w-36 bg-[#D9D9D9] rounded-[0.5rem] text-[#00000035] text-sm"
                                aria-label="Save">
                                Download File
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col sm:ms-0 md:ms-5 w-full">
                        <p class="text-[#E178C5] mt-5 font-bold">Payment Detail</p>
                        <div
                            class="flex justify-center items-center w-full h-[2rem] p-3 bg-[#FF8E8F] rounded-t-lg text-[#FFFDCB] font-bold text-sm shadow-lg ">
                            Tabungan Pokok
                        </div>
                        <div
                            class="flex justify-center items-center w-full h-[2rem] p-3 bg-[#F6F6F6] rounded-b-lg text-[#FF8E8F] font-bold text-sm shadow-lg ">
                            Rp. 1.000.000,-
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer
        class="footer footer-center items-center justify-center text-white font-semibold bg-[url('../images/background/bottom.svg')] fixed inset-x-0 bottom-0">
        <p class="text-center z-10 p-4">©2024 Unity. All rights reserved.</p>
    </footer>

</body>

</html>