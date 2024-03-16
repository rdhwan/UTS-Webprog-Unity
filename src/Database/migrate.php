<?php

require_once __DIR__ . "../../bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

$schema = Capsule::schema();

/*
    Users
*/
$schema->create("user", function (Blueprint $table) {
    $table->id();
    $table->boolean("is_active")->default(false);
    $table->string("username")->unique();
    $table->string("email")->unique();
    $table->string("password");
    $table->string("nama");
    $table->string("alamat");
    $table->enum("jenis_kelamin", ["L", "P"]);
    $table->date("tanggal_lahir");
    $table->string("profile_picture")->nullable();
    $table->enum("role", ["admin", "nasabah"]);

    $table->rememberToken();
    $table->timestamps();
});

/*
    History Simpanan
*/
$schema->create("history", function (Blueprint $table) {
    $table->id();
    $table->enum("status", ["reviewed", "verified", "rejected"]);
    $table->enum("kategori", ["pokok", "wajib", "sukarela"]);
    $table->dateTime("tanggal");
    $table->unsignedInteger("jumlah");
    $table->string("bukti");
    $table->foreignId("user_id")->constrained("user")->onDelete("cascade")->onUpdate("cascade");

    $table->timestamps();
});

/*
    SEED
*/
// insert admin
User::insert([
    "is_active" => true,
    "username" => "paduladmin",
    "email" => "padul.singlet@gmail.com",
    "password" => password_hash("hawaterciptadidunia", PASSWORD_BCRYPT),
    "nama" => "Pak Dul",
    "alamat" => "Tresur, Curug Sangereng, Kelapa Dua, Kabupaten Tangerang",
    "jenis_kelamin" => "L",
    "tanggal_lahir" => "1962-12-09",
    "profile_picture" => null,
    "role" => "admin"
]);