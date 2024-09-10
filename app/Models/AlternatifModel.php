<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternatifModel extends Model
{
    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';
    protected $fillable = ['nama', 'kategori'];
    public $timestamps = false;

    public static function get_alternatif($kategori)
    {
        return self::where('kategori', $kategori)->get();
    }
}
