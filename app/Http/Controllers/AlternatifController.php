<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternatifModel;

class AlternatifController extends Controller
{
    public function index()
    {
        $data['page'] = "Alternatif";
        $data['list'] = AlternatifModel::all();
        return view('alternatif.index', $data);
    }

    public function tambah()
    {
        $data['page'] = "Alternatif";
        return view('alternatif.tambah', $data);
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kategori' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'kategori' => $request->kategori,
        ];

        $result = AlternatifModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect('Alternatif');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect('Alternatif/tambah');
        }
    }

    public function edit($id_alternatif)
    {
        $data['page'] = "Alternatif";
        $data['alternatif'] = AlternatifModel::findOrFail($id_alternatif);
        return view('alternatif.edit', $data);
    }

    public function update(Request $request, $id_alternatif)
    {

        $this->validate($request, [
            'nama' => 'required',
            'kategori' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'kategori' => $request->kategori,
        ];

        $alternatif = AlternatifModel::findOrFail($id_alternatif);
        $alternatif->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('Alternatif');
    }

    public function destroy(Request $request, $id_alternatif)
    {
        AlternatifModel::findOrFail($id_alternatif)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('Alternatif');
    }

}
