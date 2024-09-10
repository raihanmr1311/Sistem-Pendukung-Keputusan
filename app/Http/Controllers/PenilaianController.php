<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;

class PenilaianController extends Controller
{
    public function index()
    {
        $data['page'] = "Penilaian";
        return view('penilaian.index', $data);
    }

    public function kategori(Request $request, $kategori)
    {
        $data['page'] = "Penilaian";
        $data['alternatif'] = AlternatifModel::get_alternatif($kategori);
        $data['kriteria'] = KriteriaModel::all();
        $data['kategori'] = $kategori;
        return view('penilaian.kategori', $data);
    }

    public function tambah(Request $request)
    {
        $id_alternatif = $request->input('id_alternatif');
        $id_kriteria = $request->input('id_kriteria');
        $id_sub_kriteria = $request->input('id_sub_kriteria');
        $kategori = $request->input('kategori');
        $i = 0;
        foreach ($id_sub_kriteria as $key) {
            PenilaianModel::tambah_penilaian($id_alternatif, $id_kriteria[$i], $key);
            $i++;
        }
        session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        return redirect('Penilaian/kategori/'.$kategori);
    }

    public function edit(Request $request)
    {
        $id_alternatif = $request->input('id_alternatif');
        $id_kriteria = $request->input('id_kriteria');
        $id_sub_kriteria = $request->input('id_sub_kriteria');
        $kategori = $request->input('kategori');
        $i = 0;

        foreach ($id_sub_kriteria as $key) {
            $cek = PenilaianModel::data_penilaian($id_alternatif, $id_kriteria[$i]);
            if (!$cek) {
                PenilaianModel::tambah_penilaian($id_alternatif, $id_kriteria[$i], $key);
            } else {
                PenilaianModel::edit_penilaian($id_alternatif, $id_kriteria[$i], $key);
            }
            $i++;
        }
        session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('Penilaian/kategori/'.$kategori);
    }
}
