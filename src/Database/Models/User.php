<?php
require_once __DIR__ . "/../../bootstrap.php";

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = "user";
    protected $fillable = ["is_active", "username", "email", "password", "nama", "alamat", "jenis_kelamin", "tanggal_lahir", "profile_picture", "role"];
    protected $hidden = ["password", "remember_token", "created_at", "updated_at"];

    public function histories()
    {
        return $this->hasMany("History");
    }
}