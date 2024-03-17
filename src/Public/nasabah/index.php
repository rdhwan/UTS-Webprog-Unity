
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <title>UnityBook</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="min-h-screen min-w-full font-inter">

    <!-- container navbar + content -->
    <div class="flex flex-col px-[5rem]">

        <!-- container navbar -->
        <div class="flex flex-row border-2 border-black py-[1rem] pt-[1.5rem]">
            <img src="../images/logo.png" class="w-36 md:w-24" />
            <div class="flex flex-row items-center font-semibold text-lg text-[#E178C5] w-full">
                <div class="basis-1/4 justify-center items-center border-2 border-blue-500">
                    <p class="text-center">History</p>
                </div>
                <div class="basis-1/4 justify-center items-center border-2 border-blue-500">
                    <div class="flex flex-row justify-center items-center">    
                        <div>
                            <details class="dropdown">
                                <summary class="btn font-semibold text-lg text-[#E178C5] ">
                                    <p>payment</p>
                                    <img src="../images/background/dropdownBtn.svg" class="w-4 p-0 md:w-3" />
                                </summary>
                                <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                                <li>
                                    <div>
                                        <p class="ph ph-wallet text-xl"></p>
                                        <a>Tabungan Wajib</a>
                                    </div>
                                </li> 
                                <li>
                                    <div class="text-[#FF8E8F]">
                                        <p class="ph ph-hand-coins text-xl"></p>
                                        <a>Tabungan Sukarela</a>
                                    </div>
                                </li>
                                </ul>
                            </details>
                        </div> 
                    </div>
                    
                </div>
                <div class="basis-full items-center border-2 border-blue-500 text-right text-base flex flex-row-reverse">
                <div>
                    <details class="dropdown dropdown-end">
                        <summary class="btn btn-link">
                            <img src="../images/background/dropdownBtn.svg" class="w-4 p-0 md:w-3" />
                        </summary>
                            <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                                <li>
                                    <div>
                                        <p class="ph ph-pencil-simple-line text-xl"></p>
                                        <a>Edit profile</a>
                                    </div>
                                </li> 
                                <li>
                                    <div class="text-[#FF8E8F]">
                                        <p class="ph ph-sign-out text-xl"></p>
                                        <a>Logout</a>
                                    </div>
                                </li>
                            </ul>
                    </details>
                </div>    
                <div class="pl-[1rem]">    
                        <img src="../images/profile/dummyProfile.svg" class="w-14 md:w-11" />
                    </div>
                    <div>
                        <p>Aditya Putra</p>
                        <p class="font-light text-pink-400/50">Member</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->
        <div class="flex flex-1 h-full border-2 border-rose-500 justify-center items-center">
            <p>bejier</p>
        </div>

    </div>  
    
    <footer
        class="footer footer-center items-center justify-center text-white font-semibold bg-[url('../images/background/bottom.svg')] fixed inset-x-0 bottom-0">
        <p class="text-center z-10 p-4">©2024 UnityBook. All rights reserved.</p>
    </footer>

</body>

</html>