<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKriteriaModel extends Model
{
    protected $table = 'sub_kriteria';
    protected $primaryKey = 'id_sub_kriteria';
    protected $fillable = ['id_kriteria', 'nama_sub_kriteria', 'nilai'];
    public $timestamps = false;

    public static function data_sub_kriteria($id_kriteria)
    {
        return self::where('id_kriteria', $id_kriteria)
               ->orderBy('nilai', 'asc')
               ->get();
    }
}
