<?php

require_once __DIR__ . "/../../../Middleware/checkNasabah.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $transferdate = $_POST["transferdate"];
    $transferamount = $_POST["transferamount"];

    $uploadDir = __DIR__ . "/../../images/bukti/";
    $uploadFile = $uploadDir . basename($_FILES['payment']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["payment"]["tmp_name"]);
    if ($check === false) {
        $_SESSION["error"] = "File is not an image.";
        header("Location: sukarela.php");
        exit;
    }

    if ($_FILES["payment"]["size"] > 5 * 1024 * 1024) {
        $_SESSION["error"] = "Sorry, your file is too large.";
        header("Location: sukarela.php");
        exit;
    }

    if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg") {
        $_SESSION["error"] = "Sorry, only JPG, JPEG, PNG files are allowed.";
        header("Location: sukarela.php");
        exit;
    }

    $filename = "sukarela_" . uniqid() . "." . $imageFileType;


    if (empty ($transferdate) || empty ($transferamount) || empty ($filename)) {
        $_SESSION['error'] = 'There is an empty field';
        header("Location: sukarela.php");
        exit;
    }

    $year = explode("-", $transferdate)[0];
    if ($year < 1945) {
        $_SESSION["error"] = "Birth date must be above 1945.";
        header("Location: sukarela.php");
        exit;
    }

    if (!move_uploaded_file($_FILES["payment"]["tmp_name"], $uploadDir . $filename)) {
        $_SESSION["error"] = "Sorry, there was an error uploading your file.";
        header("Location: sukarela.php");
        exit;
    }

    // create history pokok
    $user->histories()->create([
        "kategori" => "sukarela",
        "jumlah" => $transferamount,
        "bukti" => $filename,
        "status" => "reviewed",
        "tanggal" => $transferdate
    ]);

    $_SESSION["success"] = "Deposit has been successfully made.";
    header("Location: ../index.php");
    exit;
}

$kategoriSuka = $user->histories()->where('kategori', 'sukarela')->where('status', "verified")->get();
$sukarela = $kategoriSuka->sum('jumlah');


$error = $_SESSION["error"];
$_SESSION["error"] = null;

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

<body class="flex flex-col min-h-screen min-w-full font-inter p-4 md:p-8 bg-[url('../images/bgCube.png')]">
    <!-- navbar -->
    <div class="flex flex-row items-center justify-between gap-8">

        <details class="visible md:hidden dropdown">
            <summary class="btn btn-ghost text-[#E178C5]">
                <i class="ph ph-list text-4xl"></i>
            </summary>
            <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                <li>
                    <a href="../../history.php"
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
                                <a href="/src/Public/nasabah/payment/wajib.php" class="text-[#E178C5] font-semibold">
                                    <i class="ph ph-wallet text-xl"></i>
                                    Tabungan Wajib
                                </a>
                            </li>
                            <li>
                                <a href="/src/Public/nasabah/payment/sukarela.php" class="text-[#FFB38E] font-semibold">
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
                <img src="../../images/logo.png" class="w-36 md:w-24" />
            </a>

            <a href="../history.php" class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">History</a>
            <details class="dropdown">
                <summary class="btn btn-ghost font-semibold text-lg text-[#E178C5]">
                    <p>Payment</p>
                    <img src="../../images/background/dropdownBtn.svg" class="w-4 p-0 md:w-3" />
                </summary>
                <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                    <li>
                        <a href="/src/Public/nasabah/payment/wajib.php" class="text-[#E178C5] font-semibold">
                            <i class="ph ph-wallet text-xl"></i>
                            Tabungan Wajib
                        </a>
                    </li>
                    <li>
                        <a href="/src/Public/nasabah/payment/sukarela.php" class="text-[#FFB38E] font-semibold">
                            <i class="ph ph-hand-coins text-xl"></i>
                            Tabungan Sukarela
                        </a>
                    </li>
                </ul>
            </details>

        </div>

        <details class="dropdown dropdown-end">
            <summary class="btn btn-link no-underline hover:no-underline">
                <img src="../../images/profile/dummyProfile.svg" class="w-14 md:w-11" />
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
    <div class="flex flex-1 h-full my-4 justify-center">
        <div
            class="flex flex-1 flex-col md:flex-row mb-12 md:mb-4 rounded-3xl bg-gradient-to-b from-[#E178C5] to-[#FFB38E] justify-evenly items-center p-8 pt-2 md:pb-8 md:py-12 md:pr-12 md:pl-12 w-full">
            <div class="flex flex-col w-full lg:w-[50%] h-[100%] justify-between pr-[1rem]">
                <div class="flex flex-col items-start w-full  py-[2rem] md:py-0">
                    <label class="font-light text-4xl text-[#FFFDCB]">
                        Tabungan
                    </label>
                    <label class="font-bold text-5xl md:text-6xl text-[#FFFDCB] ">
                        Sukarela
                    </label>
                </div>
                <div class="flex flex-col items-start">
                    <label class="font-bold text-4xl text-[#FFFDCB]">
                        Rp.
                    </label>
                    <label class="font-bold text-4xl lg:text-6xl text-[#FFFDCB]">
                        <?= number_format($sukarela, 0, ',', '.'); ?>
                    </label>
                </div>
                <label class="font-extralight text-4xl italic text-[#FFFDCB]  py-[2rem] md:py-0">
                    Setoran sukarela memberikan fleksibilitas kepada anggota karena dapat dilakukan kapan saja.
                </label>
            </div>
            <form method="post" enctype="multipart/form-data"
                class="flex flex-col justify-evenly w-full lg:w-[50%] h-full bg-white rounded-2xl shadow-lg p-[2rem] lg:px-[4rem]">
                <label class="font-bold text-2xl lg:text-4xl text-[#E178C5] w-full text-center pb-[1rem] lg:pb-0">
                    Setor Tabungan Sukarela</label>
                <div class="flex flex-col pb-[1rem] lg:pb-0">
                    <span class="font-light text-[#FF8E8F] justify-start">Category</span>
                    <label class="flex flex-row bg-transparent rounded-none w-full">
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <input type="radio" name="category" value="W"
                                    class="radio checked:bg-[rgb(175,175,175)]" disabled />
                                <span class="label-text text-[rgb(175,175,175)] ml-[1rem]">Wajib</span>
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer">
                                <input type="radio" name="category" value="S"
                                    class="radio checked:bg-[rgb(175,175,175)] ml-[1rem]" checked />
                                <span class="label-text text-[rgb(175,175,175)] ml-[1rem]">Sukarela</span>
                            </label>
                        </div>
                    </label>
                </div>
                <div class="flex flex-col pb-[1rem] lg:pb-0">
                    <span class="font-light text-[#FF8E8F]">Date of Transfer</span>
                    <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                        <i class="ph ph-calendar opacity-35 text-2xl"></i>
                        <input required type="date" name="transferdate"
                            class="w-full bg-transparent text-[rgb(175,175,175)]"
                            placeholder="Select your date of transfer" />
                    </label>
                </div>
                <div class="flex flex-col pb-[1rem] lg:pb-0">
                    <span class="font-light text-[#FF8E8F]">Transfer Amount</span>
                    <label class="flex flex-row bg-transparent rounded-none border-b-2 w-full">
                        <i class="ph ph-credit-card opacity-35 text-2xl"></i>
                        <input required type="text" name="transferamount" class="w-full bg-transparent"
                            placeholder="Type your transfer amount" />
                    </label>
                </div>
                <div class="flex flex-col pb-[1rem] lg:pb-0">
                    <span class="font-light text-[#FF8E8F]">Upload Payment Proof</span>
                    <label class="flex flex-row items-center bg-transparent rounded-none w-full">
                        <i class="ph ph-file-arrow-up opacity-35 text-2xl"></i>
                        <input required type="file" name="payment"
                            class="file-input file-input-sm file-input-ghost text-[rgb(175,175,175)]" />
                    </label>
                </div>
                <div class="flex flex-col">
                    <?php if ($error): ?>
                        <p class="text-red-400">
                            <?= $error ?>
                        </p>
                    <?php endif; ?>
                    <button
                        class="flex justify-center items-center h-[4rem] bg-gradient-to-r from-[#E178C5] to-[#FFB38E] rounded-[3rem] text-[#FFFDCB] font-bold text-3xl px-[4rem] py-[2rem]">Submit</button>
                </div>
            </form>
        </div>


        <footer
            class="footer footer-center items-center justify-center text-white font-semibold bg-[url('../images/background/bottom.svg')] fixed inset-x-0 bottom-0">
            <p class="text-center z-10 p-4">©2024 Unity. All rights reserved.</p>
        </footer>
</body>

</html>