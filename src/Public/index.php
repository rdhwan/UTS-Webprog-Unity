<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/output.css">
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <title>UnityBook</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="flex flex-row justify-end min-h-screen min-w-full font-inter">
    <div class="invisible md:visible flex flex-1 bg-[url('../images/loginBg.png')] bg-no-repeat bg-cover"></div>
    <div class="flex flex-col w-full md:w-[33%] h-screen justify-center items-center">
        <img src="./images/logo.png" alt="logo" class="my-[2rem] w-96">
        <div class="flex flex-1 flex-col align-center gap-4 w-full p-[2rem]">
            <span class="font-light text-xl text-[#FF8E8F]">Username</span>
            <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                <i class="ph ph-user opacity-35 text-4xl"></i>
                <input type="username" name="username" class="w-full bg-transparent" placeholder="Type your username" />
            </label>
            <span class="font-light text-xl text-[#FF8E8F]">Password</span>
            <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                <i class="ph ph-lock opacity-35 text-4xl"></i>
                <input type="password" name="password" class="w-full bg-transparent" placeholder="Type your password" />
            </label>
            <div class="flex flex-col w-full items-center justify-center">
                <div class="flex justify-center w-[60%] h-[6rem] bg-red-400 my-[2rem]"></div>
                <button
                    class="flex justify-center items-center w-full h-[4rem] bg-gradient-to-r from-[#E178C5] to-[#FFB38E] rounded-[3rem] text-[#FFFDCB] font-bold text-3xl">Login</button>
            </div>
        </div>
    </div>

</body>

</html>