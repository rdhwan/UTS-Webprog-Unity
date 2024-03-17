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
    <div class="invisible lg:visible flex flex-1 bg-[url('../images/loginBg.png')] bg-no-repeat bg-cover"></div>
    <div class="flex flex-col w-full lg:w-[60%] h-screen items-center">
        <div class="flex flex-col justify-center items-center lg:items-start w-full pt-[2rem] pl-[2rem]">
            <img src="./images/logo.png" alt="logo" class="w-32 items-center justify-center">
        </div>
        <div class="flex flex-col w-[60%] items-center justify-center">
            <div class="flex text-md font-bold text-center text-4xl text-[#E178C5]">
                Create an Account
            </div>
            <div class="flex text-sm text-[rgb(175,175,175)]">Register yourself today!</div>
        </div>
        <div class="flex flex-col lg:flex-row items-center justify center w-full">
            <div class="flex flex-1 flex-col align-center justify-center gap-4 w-full p-[2rem]">
                <span class="font-light text-xl text-[#FF8E8F]">Full Name</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-user opacity-35 text-4xl"></i>
                    <input type="text" name="fullname" class="w-full bg-transparent"
                        placeholder="Type your full name" />
                </label>
                <span class="font-light text-xl text-[#FF8E8F]">Username</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-user opacity-35 text-4xl"></i>
                    <input type="username" name="username" class="w-full bg-transparent"
                        placeholder="Type your username" />
                </label>
                <span class="font-light text-xl text-[#FF8E8F]">Password</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-lock opacity-35 text-4xl"></i>
                    <input type="password" name="password" class="w-full bg-transparent"
                        placeholder="Type your password" />
                </label>
                <span class="font-light text-xl text-[#FF8E8F]">Email</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-at opacity-35 text-4xl"></i>
                    <input type="email" name="email" class="w-full bg-transparent" placeholder="Type your email" />
                </label>
            </div>
            <div class="flex flex-1 flex-col align-center justify-center gap-4 w-full p-[2rem]">
                <span class="font-light text-xl text-[#FF8E8F]">Address</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-map-pin opacity-35 text-4xl"></i>
                    <input type="text" name="address" class="w-full bg-transparent" placeholder="Type your address" />
                </label>
                <span class="font-light text-xl text-[#FF8E8F]">Gender</span>
                <label class="flex flex-row bg-transparent rounded-none w-full">
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <input type="radio" name="radio-10" class="radio checked:bg-[rgb(175,175,175)]" checked />
                            <span class="label-text text-lg text-[rgb(175,175,175)] ml-[1rem]">Male</span>
                        </label>
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <input type="radio" name="radio-10" class="radio checked:bg-[rgb(175,175,175)] ml-[1rem]"
                                checked />
                            <span class="label-text text-lg text-[rgb(175,175,175)] ml-[1rem]">Female</span>
                        </label>
                    </div>
                </label>
                <span class="font-light text-xl text-[#FF8E8F]">Date of Birth</span>
                <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                    <i class="ph ph-calendar opacity-35 text-4xl"></i>
                    <input type="date" name="birthdate" class="w-full bg-transparent"
                        placeholder="Enter your birthdate" />
                </label>
                <span class="font-light text-xl text-[#FF8E8F]">Upload Payment Proof</span>
                <label class="flex flex-row bg-transparent rounded-none w-full">
                    <i class="ph ph-file-arrow-up opacity-35 text-4xl"></i>
                    <input type="file" name="payment" class="file-input file-input-ghost text-[rgb(175,175,175)]" />
                </label>
            </div>

        </div>
        <div class="flex flex-col w-full items-center justify-center">
            <div class="flex justify-center w-[60%] h-[6rem] bg-red-400 my-[2rem]"></div>
            <button
                class="flex justify-center items-center h-[4rem] bg-gradient-to-r from-[#E178C5] to-[#FFB38E] rounded-[3rem] text-[#FFFDCB] font-bold text-3xl px-[4rem]">Register</button>
            <div class="flex text-sm text-[rgb(175,175,175)]">Already have an account? <a href="./login.php"
                    class="text-[#E178C5] font-bold pl-1"> Login</a></div>
        </div>
    </div>

</body>

</html>