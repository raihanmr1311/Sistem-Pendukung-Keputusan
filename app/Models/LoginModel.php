<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoginModel extends Model
{
    public function login($username, $passwordx)
    {
        return DB::table('user')
            ->select('*')
            ->where('username', $username)
            ->where('password', $passwordx)
            ->first();
    }
}
