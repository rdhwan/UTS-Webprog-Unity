<?php
require_once __DIR__ . "/../../bootstrap.php";

use Illuminate\Database\Eloquent\Model as Eloquent;

class History extends Eloquent
{
    protected $table = "history";
    protected $fillable = ["status", "kategori", "tanggal", "jumlah", "bukti"];
    protected $hidden = ["created_at", "updated_at"];

    public function user()
    {
        return $this->belongsTo("User");
    }


}