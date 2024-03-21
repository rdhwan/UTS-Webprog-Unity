<?php
// @albert
require_once __DIR__ . "/../../Middleware/checkAdmin.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset ($_FILES['newprofilepict']) && $_FILES['newprofilepict']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . "/../images/profile/";
        $uploadFile = $uploadDir . basename($_FILES['newprofilepict']['name']);
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["newprofilepict"]["tmp_name"]);
        if ($check === false) {
            $_SESSION["error"] = "File is not an image.";
            header("Location: profile.php");
            exit;
        }

        if ($_FILES["newprofilepict"]["size"] > 5 * 1024 * 1024) {
            $_SESSION["error"] = "Sorry, your file is too large.";
            header("Location: profile.php");
            exit;
        }

        if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg") {
            $_SESSION["error"] = "Sorry, only JPG, JPEG, PNG files are allowed.";
            header("Location: profile.php");
            exit;
        }

        $newProfilePic = "profile_" . uniqid() . "." . $imageFileType;

        if (!move_uploaded_file($_FILES["newprofilepict"]["tmp_name"], $uploadDir . $newProfilePic)) {
            $_SESSION["error"] = "Sorry, there was an error uploading your file.";
            header("Location: profile.php");
            exit;
        }

        $user->profile_picture = $newProfilePic;
        $user->save();

        $_SESSION["success"] = "Profile picture updated successfully!";
        header("Location: profile.php");
        exit;
    } else {
        $_SESSION["error"] = "No file uploaded or upload error occurred.";
        header("Location: profile.php");
        exit;
    }
}
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
                <?php if (!empty ($user["profile_picture"])): ?>
                    <img src="../images/profile/<?= $user["profile_picture"] ?>" class="w-14 md:w-11 rounded-full" />
                <?php else: ?>
                    <img src="../images/profile/dummyProfile.svg" class="w-14 md:w-11 rounded-full" />
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
            class="mb-[3rem] md:mb-0 flex flex-col relative bg-gradient-to-r from-[#E178C5] to-[#FFB38E] p-5 md:w-[40rem] w-[18rem] h-auto rounded-2xl shadow-lg">
            <div class="bg-[#f6f6f6] rounded-xl md:p-[2rem] p-[1rem]">
                <div class="flex justify-between">
                    <span class="text-3xl font-bold text-[#FF8E8F]">
                        My Account
                    </span>
                    <a href="index.php" class="flex-column justify-center mb-5 items-center ">
                        <i class="mb-1 flex justify-center ph-bold ph-x text-center  text-[#1F1F1F]/35"></i>
                        <p class="text-sm text-[#FF8E8F] font-bold hidden sm:block">ESC</p>
                    </a>
                </div>
                <div class="md:flex flex-column md:justify-between">
                    <div class="flex">
                        <?php if (!empty ($user["profile_picture"])): ?>
                            <img src="../images/profile/<?= $user["profile_picture"] ?>"
                                class="w-20 h-20 object-cover mr-5 rounded-full" />
                        <?php else: ?>
                            <img src="../images/profile/dummyProfile.svg"
                                class="w-20 h-20 object-cover mr-5 rounded-full" />
                        <?php endif; ?>
                        <div class="flex items-center">
                            <div class="md:flex flex-col items-start text-lg">
                                <p class="font-semibold text-[#E178C5]">
                                    <?= $user["nama"] ?>
                                </p>
                                <p class="font-light text-[#E178C5]/50">Nasabah</p>
                            </div>
                        </div>

                    </div>
                    <div class="flex justify-content-end items-center">
                        <a href="edit.php">
                            <button
                                class="shadow-lg md:ms-5 ms-0 md:mt-0 mt-5 flex justify-center items-center h-[2rem] w-[10rem] p-3 bg-gradient-to-r from-[#E178C5] to-[#FFB38E] rounded-[0.5rem] text-[#FFFDCB] font-bold text-sm">
                                Edit User Profile
                            </button>
                        </a>
                    </div>

                </div>
                <hr class="my-2 border-[#FF8E8F] w-full mt-5" />
                <div class="md:flex flex-column ">
                    <form action="profile.php" method="POST" enctype="multipart/form-data">
                        <div class="flex flex-col">
                            <p class="text-[#E178C5] mt-5 font-bold">Change Profile Picture</p>
                            <form action="profile.php" method="POST" enctype="multipart/form-data">
                                <label for="newprofilepict"
                                    class="flex flex-row items-center bg-transparent rounded-none w-full">
                                    <i class="ph ph-file-arrow-up opacity-35 text-2xl"></i>
                                    <input id="newprofilepict" required type="file" name="newprofilepict"
                                        class="file-input file-input-sm file-input-ghost text-[rgb(175,175,175)]"
                                        aria-label="Choose file">
                                </label>
                                <?php if (!empty ($error)): ?>
                                    <p class="text-red-500">
                                        <?php echo $error; ?>
                                    </p>
                                <?php endif; ?>
                                <button type="submit"
                                    class="shadow-lg mt-1 flex justify-center items-center h-[2rem] w-[5rem] p-3 bg-gradient-to-r from-[#E178C5] to-[#FFB38E] rounded-[0.5rem] text-[#FFFDCB] font-bold text-sm"
                                    aria-label="Save">
                                    SAVE
                                </button>
                            </form>
                        </div>

                    </form>

                    <div class="flex flex-col sm:ms-0 md:ms-5">
                        <p class="text-[#E178C5] mt-5 font-bold">Change Your Password</p>
                        <a href="reset-password.php">
                            <button
                                class="my-2 flex justify-center items-center w-[10rem] h-[2rem] p-3 bg-[#FF8E8F] rounded-[0.5rem] text-[#FFFDCB] font-bold text-sm shadow-lg ">
                                Reset
                                Password</button>
                        </a>
                    </div>
                </div>
                <a href="../logout.php" class="flex items-center justify-end mt-5">
                    <i class="ph-bold ph-sign-out text-md text-[#FF8E8F]"></i>
                    <p class="text-[#FF8E8F] ms-2 font-bold">Logout</p>
                </a>
            </div>
        </div>
    </div>


    <footer
        class="footer footer-center items-center justify-center text-white font-semibold bg-[url('../images/background/bottom.svg')] fixed inset-x-0 bottom-0">
        <p class="text-center z-10 p-4">©2024 Unity. All rights reserved.</p>
    </footer>

</body>

</html>