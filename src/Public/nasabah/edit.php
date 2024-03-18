<?php
// @albert
require_once __DIR__ . "/../../Middleware/checkNasabah.php";

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
                    <a href="./history.php"
                        class="btn btn-ghost flex items-center justify-start font-semibold text-lg text-[#E178C5]">History
                    </a>
                </li>
                <li>
                    <details class="dropdown">
                        <summary
                            class="btn btn-ghost flex items-center justify-start font-semibold text-lg text-[#E178C5]">
                            <p>Payment</p>
                        </summary>
                        <ul tabindex="0"
                            class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                            <li>
                                <a href="/src/Public/nasabah/wajib.php" class="text-[#E178C5] font-semibold">
                                    <i class="ph ph-wallet text-xl"></i>
                                    Tabungan Wajib
                                </a>
                            </li>
                            <li>
                                <a href="/src/Public/nasabah/sukarela.php" class="text-[#FFB38E] font-semibold">
                                    <i class="ph ph-hand-coins text-xl"></i>
                                    Tabungan Sukarela
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>
            </ul>
        </details>



        <div class="hidden md:flex flex-row items-center gap-8">
            <a href="/src/Public/nasabah/index.php">
                <img src="../images/logo.png" class="w-36 md:w-24" />
            </a>

            <a href="./history.php" class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">History</a>
            <details class="dropdown">
                <summary class="btn btn-ghost font-semibold text-lg text-[#E178C5]">
                    <p>Payment</p>
                    <img src="../images/background/dropdownBtn.svg" class="w-4 p-0 md:w-3" />
                </summary>
                <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                    <li>
                        <a href="/src/Public/nasabah/wajib.php" class="text-[#E178C5] font-semibold">
                            <i class="ph ph-wallet text-xl"></i>
                            Tabungan Wajib
                        </a>
                    </li>
                    <li>
                        <a href="/src/Public/nasabah/sukarela.php" class="text-[#FFB38E] font-semibold">
                            <i class="ph ph-hand-coins text-xl"></i>
                            Tabungan Sukarela
                        </a>
                    </li>
                </ul>
            </details>

        </div>

        <details class="dropdown dropdown-end">
            <summary class="btn btn-link no-underline hover:no-underline">
                <img src="../images/profile/dummyProfile.svg" class="w-14 md:w-11" />
                <div class="hidden md:flex flex-col items-start">
                    <p class="font-semibold text-[#E178C5]">
                        <?= $user["nama"] ?>
                    </p>
                    <p class="font-light text-[#E178C5]/50">Nasabah</p>
                </div>
            </summary>
            <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                <div class="flex md:hidden flex-col p-4">
                    <p class="font-semibold text-[#E178C5]">
                        <?= $user["nama"] ?>
                    </p>
                    <p class="font-light text-[#E178C5]/50">Nasabah</p>

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
    <div class="flex flex-1 h-full my-4 justify-center items-center">
        <div
            class="mb-[3rem] md:mb-0 flex flex-col relative bg-gradient-to-r from-[#E178C5] to-[#FFB38E] p-5 w-75 h-auto rounded-2xl shadow-lg">
            <div class="bg-[#f6f6f6] rounded-xl md:p-[1.5rem] p-[1rem]">
                <div class="flex justify-between">
                    <span class="md:text-3xl text-xl font-bold text-[#FF8E8F] pt-[1rem] pl-[1rem]">
                        Edit User Profile
                    </span>
                    <a href="profile.php" class="flex-column justify-center mb-5 items-center ">
                        <i class="mb-1 flex justify-center ph-bold ph-x text-center  text-[#1F1F1F]/35"></i>
                        <p class="text-sm text-[#FF8E8F] font-bold hidden sm:block">ESC</p>
                    </a>
                </div>
                <div class="flex flex-col lg:flex-row items-center justify center w-full">
                    <div class="flex flex-1 flex-col align-center justify-center gap-4 w-full p-[1rem]">
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
                    <div class="flex flex-1 flex-col align-center justify-center gap-4 w-full p-[1rem]">
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
                                    <input type="radio" name="gender" value="L"
                                        class="radio checked:bg-[rgb(175,175,175)]" />
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
                            <input required type="date" name="birthdate"
                                class="w-full bg-transparent text-[rgb(175,175,175)]"
                                placeholder="Enter your birthdate" />
                        </label>
                        <div class="flex flex-col">
                            <p class="text-[#E178C5] font-bold">Change Your Password</p>
                            <a href="reset-password.php">
                                <button
                                    class="flex justify-center items-center w-[10rem] h-[2rem] p-3 bg-[#FF8E8F] rounded-[0.5rem] text-[#FFFDCB] font-bold text-sm shadow-lg ">
                                    Reset
                                    Password</button>
                            </a>
                        </div>
                    </div>
                    <!-- <div class="flex">
                    <div class="flex-col"></div>
                    <div class="flex-col"></div>
                </div> -->

                </div>
            </div>
        </div>


        <footer
            class="footer footer-center items-center justify-center text-white font-semibold bg-[url('../images/background/bottom.svg')] fixed inset-x-0 bottom-0">
            <p class="text-center z-10 p-4">©2024 UnityBook. All rights reserved.</p>
        </footer>

</body>

</html>