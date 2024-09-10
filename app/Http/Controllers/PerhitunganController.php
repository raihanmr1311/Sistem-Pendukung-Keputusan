<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerhitunganModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    public function index()
    {
        $id_user_level = session('log.id_user_level');
        
        // if ($id_user_level != 1) {
            // ?> <script>
        //         window.location='<?php echo url("Dashboard"); ?>'
        //         alert('Anda tidak berhak mengakses halaman ini!');
        //     </script><?php
        // }

        $data['page'] = "Perhitungan";
        return view('perhitungan.index', $data);
    }

    public function kategori(Request $request, $kategori)
    {
        // $id_user_level = session('log.id_user_level');
        
        // if ($id_user_level != 1) {
        //     ?> <script>
        //         window.location='<?php echo url("Dashboard"); ?>'
        //         alert('Anda tidak berhak mengakses halaman ini!');
        //     </script><?php
        // }

        $data['page'] = "Perhitungan";
        $data['alternatifs'] = AlternatifModel::get_alternatif($kategori);
        $data['kriterias'] = KriteriaModel::all();
        $data['kategori'] = $kategori;
        return view('perhitungan.kategori', $data);
    }
}
