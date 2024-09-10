<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class ProfileController extends Controller
{
    public function index()
    {
        $id_user = session('log.id_user');
        $data['page'] = "Profile";
        $data['profile'] = UserModel::findOrFail($id_user);
        return view('profile.index', $data);
    }

    public function update(Request $request, $id_user)
    {
        $this->validate($request, [
            'email' => 'required',
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->input('email'),
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'password' => md5($request->input('password'))
        ];

        $user = UserModel::findOrFail($id_user);
        $user->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data profile berhasil diupdate!</div>');
        return redirect('Profile');
    }

}
