<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PerhitunganModel extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $fillable = ['id_alternatif', 'id_kriteria', 'id_sub_kriteria'];
    public $timestamps = false;

    public static function data_nilai($id_alternatif, $id_kriteria)
    {
        return self::join('sub_kriteria', 'penilaian.id_sub_kriteria', '=', 'sub_kriteria.id_sub_kriteria')
            ->where('penilaian.id_alternatif', $id_alternatif)
            ->where('penilaian.id_kriteria', $id_kriteria)
            ->first();
    }

    public static function hapus_hasil($kategori)
    {
        DB::table('hasil')->where('kategori', $kategori)->delete();
        return true;
    }

    public static function get_hasil($kategori)
    {
        return DB::table('hasil')
            ->join('alternatif', 'hasil.id_alternatif', '=', 'alternatif.id_alternatif')
            ->where('hasil.kategori', $kategori)
            ->orderBy('nilai', 'DESC')
            ->get();
    }
}
