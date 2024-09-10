<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $data['page'] = "User";
        $data['list'] = UserModel::get_user();
        return view('user.index', $data);
    }

    public function tambah()
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $data['page'] = "User";
        $data['user_level'] = UserModel::get_user_level();
        return view('user.tambah', $data);
    }

    public function simpan(Request $request)
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'privilege' => 'required',
            'username' => 'required|unique:user',
            'password' => 'required',
        ]);

        $data = [
            'id_user_level' => $request->input('privilege'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => md5($request->input('password'))
        ];

        $result = UserModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect('User');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect('User/tambah');
        }
    }

    public function edit($id_user)
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $data['page'] = "User";
        $data['user_level'] = UserModel::get_user_level();
        $data['user'] = UserModel::findOrFail($id_user);
        return view('user.edit', $data);
    }

    public function detail($id_user)
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $data['page'] = "User";
        $data['user_level'] = UserModel::get_user_level();
        $data['user'] = UserModel::findOrFail($id_user);
        return view('user.detail', $data);
    }

    public function update(Request $request, $id_user)
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'privilege' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'id_user_level' => $request->input('privilege'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => md5($request->input('password'))
        ];

        $user = UserModel::findOrFail($id_user);
        $user->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('User');
    }

    public function destroy(Request $request, $id_user)
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }
        
        UserModel::findOrFail($id_user)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('User');
    }

}
