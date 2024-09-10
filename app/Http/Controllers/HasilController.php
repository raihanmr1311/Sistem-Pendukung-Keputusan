<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerhitunganModel;

class HasilController extends Controller
{
    public function index()
    {
        $data['page'] = "Hasil";
        return view('hasil.index', $data);
    }

    public function kategori(Request $request, $kategori)
    {
        $data['page'] = "Hasil";
        $data['hasil'] = PerhitunganModel::get_hasil($kategori);
        $data['kategori'] = $kategori;
        return view('hasil.kategori', $data);
    }

    public function Laporan(Request $request, $kategori)
    {
        $data['hasil'] = PerhitunganModel::get_hasil($kategori);
        $data['kategori'] = $kategori;
        return view('hasil.laporan', $data);
    }
}
