<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $fillable = ['id_kriteria', 'nama_kriteria', 'kode_kriteria', 'bobot', 'jenis'];
    public $timestamps = false;

    public static function get_all_kriteria($sort = 'asc')
    {
        return self::orderBy('id_kriteria', $sort)
            ->get();
    }

    public static function delete_kriteria_ahp()
    {
        DB::table('kriteria_ahp')->truncate();
        return true;
    }

    public static function add_kriteria_ahp($params)
    {
        DB::table('kriteria_ahp')->insert($params);
    }

    public static function update_kriteria_ahp($id_kriteria_1, $id_kriteria_2, $params)
    {
        DB::table('kriteria_ahp')
            ->where('id_kriteria_1', $id_kriteria_1)
            ->where('id_kriteria_2', $id_kriteria_2)
            ->update($params);
    }

    public static function get_kriteria_ahp($id_kriteria_1, $id_kriteria_2)
    {
        return DB::table('kriteria_ahp')
            ->where('id_kriteria_1', $id_kriteria_1)
            ->where('id_kriteria_2', $id_kriteria_2)
            ->first();
    }

    public static function update_prioritas($params)
    {
        $bobot = $params['bobot'];
        static::query()->update(['bobot' => $bobot]);
    }
}
