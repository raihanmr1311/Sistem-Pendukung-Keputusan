<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteriaModel;
use App\Models\KriteriaModel;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $data['page'] = "Sub Kriteria";
        $data['kriteria'] = KriteriaModel::all();
        return view('sub_kriteria.index', $data);
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
            'id_kriteria' => 'required',
            'nama_sub_kriteria' => 'required',
            'nilai' => 'required'
        ]);

        $data = [
            'id_kriteria' => $request->id_kriteria,
            'nama_sub_kriteria' => $request->nama_sub_kriteria,
            'nilai' => $request->nilai
        ];

        $result = SubKriteriaModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect('SubKriteria');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect('SubKriteria');
        }
    }

    public function edit(Request $request, $id_sub_kriteria)
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
            'id_kriteria' => 'required',
            'nama_sub_kriteria' => 'required',
            'nilai' => 'required'
        ]);

        $data = [
            'id_kriteria' => $request->id_kriteria,
            'nama_sub_kriteria' => $request->nama_sub_kriteria,
            'nilai' => $request->nilai
        ];

        $subkriteria = SubKriteriaModel::findOrFail($id_sub_kriteria);
        $subkriteria->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('SubKriteria');
    }

    public function destroy(Request $request, $id_sub_kriteria)
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
        
        SubKriteriaModel::findOrFail($id_sub_kriteria)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('SubKriteria');
    }
}
