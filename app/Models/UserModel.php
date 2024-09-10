<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['id_user_level','nama','email','username','password'];
    public $timestamps = false;

    public static function get_user()
    {
        return self::join('user_level', 'user.id_user_level', '=', 'user_level.id_user_level')->get();
    }

    public static function get_user_level()
    {
        return DB::table('user_level')->get();
    }
}
