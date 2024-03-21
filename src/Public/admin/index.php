<?php

require_once __DIR__ . "/../../Middleware/checkAdmin.php";

//Cek pokok
$kategoriPokok = History::where('kategori', 'pokok')->where('status', "verified")->get();
$pokok = $kategoriPokok->sum('jumlah');

$kategoriWajib = History::where('kategori', 'wajib')->where('status', "verified")->get();
$wajib = $kategoriWajib->sum('jumlah');

$kategoriSuka = History::where('kategori', 'sukarela')->where('status', "verified")->get();
$sukarela = $kategoriSuka->sum('jumlah');

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
            <a href="/src/Public/nasabah/index.php">
                <img src="../images/logo.png" class="w-36 md:w-24" />
            </a>

            <a href="./users/index.php" class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">Users</a>
            <a href="./history/index.php"
                class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">History</a>

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
                    <div class="text-[#E178C5] text-base">
                        <p class="ph ph-pencil-simple-line text-xl"></p>
                        <a href="./profile.php">Edit profile</a>
                    </div>
                </li>
                <li>
                    <div class="text-[#FF8E8F] text-base">
                        <p class="ph ph-sign-out text-xl"></p>
                        <a href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </details>

    </div>



    <!-- content -->
    <div class="flex flex-1 h-full my-4 flex-col lg:flex-row gap-8">
        <div class="flex flex-col w-full justify-center items-center ml-0 lg:ml-2">
            <div
                class="flex w-[100%] h-[100%] rounded-[1rem] mb-0 lg:mb-[2.5rem] bg-gradient-to-br from-[#E178C5] to-[#FFB38E] shadow-lg">
                <div class="flex flex-col text-[#FFFDCB] ml-[2.5rem] my-[3rem] text-2xl justify-between pr-2 lg:pr-0">
                    <div class="lg:mb-0 mb-10">
                        <p class="text-2xl font-light">Tabungan</p>
                        <p class="text-[3.8rem] font-semibold mt-[1rem]">POKOK</p>
                    </div>
                    <div class="lg:mb-0 mb-8">
                        <p class="text-[1.75rem] md:text-[2rem] font-semibold">Rp.</p>
                        <p class="text-[3.5rem] md:text-[3.8rem] font-bold mt-4">
                            <?= number_format($pokok, 0, ',', '.'); ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-xl md:text-2xl font-light italic">Setoran awal saat bergabung, <br>
                            berperan sebagai modal awal koperasi.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-[100%] mb-[2.5rem] mr-[2rem]">
            <div class="flex-1 flex flex-col justify-between">
                <div
                    class="flex w-full h-[100%] rounded-[1rem] bg-gradient-to-br from-[#E178C5] to-[#FFB38E] shadow-lg mb-[1rem]">
                    <div
                        class="flex flex-col text-[#FFFDCB] ml-[2.5rem] my-[1rem] text-2xl justify-between w-full py-2 mr-4 lg:mr-0">
                        <div class="flex lg:mb-0 mb-8 lg:mt-0 mt-3">
                            <p class="text-4xl md:text-5xl font-semibold">WAJIB</p>
                        </div>
                        <div class="lg:mb-0 mb-8">
                            <p class="text-[1.75rem] md:text-[2rem] font-semibold">Rp.</p>
                            <p class="text-[3.5rem] md:text-[3.8rem] font-bold mt-4">
                                <?= number_format($wajib, 0, ',', '.'); ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-xl md:text-2xl font-light italic">Setoran bulanan yang wajib, mendukung<br>
                                keberlanjutan operasional koperasi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 flex flex-col justify-between">
                <div class="flex w-full h-full rounded-[1rem] bg-gradient-to-br from-[#E178C5] to-[#FFB38E] shadow-lg">
                    <div
                        class="flex flex-col text-[#FFFDCB] ml-[2.5rem] my-[1rem] text-2xl justify-between w-full py-2 mr-4 lg:mr-0">
                        <div class="flex lg:mb-0 mb-8 lg:mt-0 mt-3">
                            <p class="text-4xl md:text-5xl font-semibold">SUKARELA</p>
                        </div>
                        <div class="lg:mb-0 mb-8">
                            <p class="text-[1.75rem] md:text-[2rem] font-semibold">Rp.</p>
                            <p class="text-[3.5rem] md:text-[3.8rem] font-bold mt-4">
                                <?= number_format($sukarela, 0, ',', '.'); ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-xl md:text-2xl font-light italic">Setoran sukarela memberikan fleksibilitas
                                kepada <br>
                                anggota karena dapat dilakukan kapan saja</p>
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