<?php

require_once __DIR__ . "/../../../Middleware/checkAdmin.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["id"];
    
    $nasabah = User::find($id);
    if ($nasabah === null) {
        header("Location: index.php");
        exit;
    }

    $nasabah->update(["is_active" => !$nasabah["is_active"]]);
    $nasabah->histories()->where("kategori", "=", "pokok")->update(["status" => $nasabah["is_active"] ? "verified" : "reviewed"]);

    header("Location: index.php");
}


$users = User::where("role", "=", "nasabah")->get();

?>


<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/output.css">
    <!-- mitigasi datatable -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../../images/logo.png" type="image/x-icon">
    <title>Unity</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.tailwindcss.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.tailwindcss.css">

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
            <a href="/admin/index.php">
                <img src="../../images/logo.png" class="w-36 md:w-24" />
            </a>

            <a href="../users/index.php"
                class="btn btn-ghost text-center font-semibold text-lg text-[#E178C5]">Users</a>
            <a href="../history/index.php"
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
                <img src="../../images/profile/<?= $user["profile_picture"] ?>" class="w-14 md:w-11 rounded-full" />
                <?php else: ?>
                <img src="../../images/profile/dummyProfile.svg" class="w-14 md:w-11 rounded-full" />
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



    <!-- override tailwind style -->
    <style>
    .dt-container {
        flex: 1;
    }

    #dt-length-0 {
        background-color: white;
    }

    #dt-search-0 {
        background-color: white;
    }

    .pagination>a {
        background-color: white;
        color: black;
    }

    thead>tr {
        background-color: #F6F6F6;
        color: black;
    }

    .dt-column-title {
        color: black;
        font-weight: 600;
    }

    #row {
        background-color: white;
    }

    #title {
        background-color: #F6F7F8;
    }

    #row:nth-child(even) {
        background-color: #F6F6F6;
    }
    </style>



    <!-- content -->
    <div class="flex flex-1 h-full my-4 justify-center">
        <div
            class="flex flex-1 flex-col md:flex-row mb-12 md:mb-4 rounded-3xl bg-gradient-to-b from-[#E178C5] to-[#FFB38E] justify-center items-center p-8 pt-2 md:pb-8 md:py-12 md:pr-12 md:pl-2">
            <div
                class="flex flex-row md:flex-row-reverse md:self-end m-4 md:m-8 md:[writing-mode:vertical-lr] md:rotate-180">
                <i
                    class="ph ph-users-three md:rotate-180 text-5xl md:text-7xl text-[#FFFDCB] my-0 mx-2 md:mx-0 md:my-2"></i>
                <div class="flex text-5xl md:text-7xl font-bold text-[#FFFDCB]">
                    Users
                </div>
            </div>
            <div class="flex w-full h-full bg-white rounded-2xl shadow-lg p-4 overflow-scroll">
                <table id="users" class="display w-full h-full">
                    <thead>
                        <tr>
                            <th id="title">Username</th>
                            <th id="title">Full Name</th>
                            <th id="title">Email</th>
                            <th id="title">Gender</th>
                            <th id="title">Birth Date</th>
                            <th id="title">Status</th>
                            <th id="title">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($users as $u): ?>
                        <tr id="row">
                            <td>
                                <?= $u->username ?>
                            </td>
                            <td>
                                <?= $u->nama ?>
                            </td>
                            <td>
                                <?= $u->email ?>
                            </td>
                            <td>
                                <?= $u->jenis_kelamin === "L" ? "Laki-Laki" : "Perempuan" ?>
                            </td>
                            <td>
                                <?= $u->tanggal_lahir ?>
                            </td>
                            <td>
                                <form name="activeToggle_<?= $u->id ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $u->id ?>">
                                    <input type="checkbox" class="toggle toggle-success"
                                        onchange="document.activeToggle_<?= $u->id ?>.submit()"
                                        <?php if ($u->is_active) echo "checked" ?> />
                                </form>
                            </td>

                            <td class="flex flex-row gap-2">
                                <a href="detail.php?id=<?= $u->id ?>" class="btn btn-sm btn-secondary font-normal">
                                    Detail
                                </a>

                                <button class="btn btn-sm btn-error" onclick="delete_modal_<?= $u->id ?>.showModal()">
                                    <i class="ph ph-user-circle-minus text-xl text-black/85"></i>
                                </button>

                                <dialog id="delete_modal_<?= $u->id ?>" class="modal">
                                    <div class="modal-box">
                                        <h3 class="font-bold text-lg">Delete User</h3>
                                        <p class="py-4">Are you sure to delete user
                                            <span class="font-bold">
                                                <?= $u->nama ?>
                                            </span>
                                            ?
                                        </p>
                                        <div class="modal-action">
                                            <form method="dialog">
                                                <!-- if there is a button in form, it will close the modal -->
                                                <a href="delete.php?id=<?= $u->id ?>" class="btn btn-error">Delete</a>
                                                <button class="btn">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>


                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <footer class=" footer footer-center items-center justify-center text-white font-semibold
                                        bg-[url('../images/background/bottom.svg')] fixed inset-x-0 bottom-0">
        <p class="text-center z-10 p-4">©2024 Unity. All rights reserved.</p>
    </footer>


    <script>
    new DataTable("#users");
    </script>

</body>

</html>