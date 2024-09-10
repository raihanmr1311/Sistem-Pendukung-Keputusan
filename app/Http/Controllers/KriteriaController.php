<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KriteriaModel;

class KriteriaController extends Controller
{
    public function index()
    {   
        $data['page'] = "Kriteria";
        $data['list'] = KriteriaModel::all();
        return view('kriteria.index', $data);
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

        $data['page'] = "Kriteria";
        return view('kriteria.tambah', $data);
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
            'nama_kriteria' => 'required',
            'kode_kriteria' => 'required',
            'jenis' => 'required',
        ]);

        $data = [
            'nama_kriteria' => $request->nama_kriteria,
            'kode_kriteria' => $request->kode_kriteria,
            'jenis' => $request->jenis,
        ];

        $result = KriteriaModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect()->route('Kriteria');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect()->route('Kriteria/tambah');
        }
    }

    public function edit($id_kriteria)
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

        $data['page'] = "Kriteria";
        $data['kriteria'] = KriteriaModel::findOrFail($id_kriteria);
        return view('kriteria.edit', $data);
    }

    public function update(Request $request, $id_kriteria)
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
            'nama_kriteria' => 'required',
            'kode_kriteria' => 'required',
            'jenis' => 'required',
        ]);

        $data = [
            'nama_kriteria' => $request->nama_kriteria,
            'kode_kriteria' => $request->kode_kriteria,
            'jenis' => $request->jenis,
        ];

        $kriteria = KriteriaModel::findOrFail($id_kriteria);
        $kriteria->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect()->route('Kriteria');
    }

    public function destroy(Request $request, $id_kriteria)
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

        KriteriaModel::findOrFail($id_kriteria)->delete();        
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect()->route('Kriteria');
    }

    public function ahp_kriteria(Request $request)
    {
        $data['page'] = "Kriteria";
        $data['kriteria'] = KriteriaModel::get_all_kriteria();

        if ($request->has('save')) {
            KriteriaModel::delete_kriteria_ahp();
            $i = 0;
            foreach ($data['kriteria'] as $row1) {
                $ii = 0;
                foreach ($data['kriteria'] as $row2) {
                    if ($i < $ii) {
                        $nilai_input = request()->input('nilai_' . $row1->id_kriteria . '_' . $row2->id_kriteria);
                        $nilai_1 = 0;
                        $nilai_2 = 0;
                        if ($nilai_input < 1) {
                            $nilai_1 = abs($nilai_input);
                            $nilai_2 = 1 / abs($nilai_input);
                        } elseif ($nilai_input > 1) {
                            $nilai_1 = 1 / abs($nilai_input);
                            $nilai_2 = abs($nilai_input);
                        } elseif ($nilai_input == 1) {
                            $nilai_1 = 1;
                            $nilai_2 = 1;
                        }
                        $params = array(
                            'id_kriteria_1' => $row1->id_kriteria,
                            'id_kriteria_2' => $row2->id_kriteria,
                            'nilai_1' => $nilai_1,
                            'nilai_2' => $nilai_2,
                        );
                        KriteriaModel::add_kriteria_ahp($params);
                    }
                    $ii++;
                }
                $i++;
            }
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Nilai perbandingan kriteria berhasil disimpan!</div>');
            return redirect()->route('ahp_kriteria');
        }

        if ($request->has('check')) {
            if (count($data['kriteria']) < 3) {					
                $request->session()->flash('pesan_error', '<div class="alert alert-success" role="alert">Jumlah kriteria kurang, minimal 3!</div>');
            } else {
                $id_kriteria = array();
                foreach ($data['kriteria'] as $row)
                    $id_kriteria[] = $row->id_kriteria;
            }

            $matrik_kriteria = $this->ahp_get_matrik_kriteria($id_kriteria);
            $jumlah_kolom = $this->ahp_get_jumlah_kolom($matrik_kriteria);
            $matrik_normalisasi = $this->ahp_get_normalisasi($matrik_kriteria, $jumlah_kolom);
            $prioritas = $this->ahp_get_prioritas($matrik_normalisasi);
            $matrik_baris = $this->ahp_get_matrik_baris($prioritas, $matrik_kriteria);
            $jumlah_matrik_baris = $this->ahp_get_jumlah_matrik_baris($matrik_baris);
            $hasil_tabel_konsistensi = $this->ahp_get_tabel_konsistensi($jumlah_matrik_baris, $prioritas);
            if ($this->ahp_uji_konsistensi($hasil_tabel_konsistensi)) {
                $request->session()->flash('message', '<div class="alert alert-success" role="alert">Nilai perbandingan : KONSISTEN!</div>');
                $i = 0;
                foreach ($data['kriteria'] as $row) {
                    $params = array(
                        'bobot' => $prioritas[$i],
                    );

                    $kriteria = KriteriaModel::findOrFail($row->id_kriteria);
                    $kriteria->update($params);
                    $i++;
                }

                $data['list_data'] = $this->tampil_data_1($matrik_kriteria, $jumlah_kolom);
                $data['list_data2'] = $this->tampil_data_2($matrik_normalisasi, $prioritas);
                $data['list_data3'] = $this->tampil_data_3($matrik_baris, $jumlah_matrik_baris);
                $list_data = $this->tampil_data_4($jumlah_matrik_baris, $prioritas, $hasil_tabel_konsistensi);
                $data['list_data4'] = $list_data[0];
                $data['list_data5'] = $list_data[1];
            } else {
                $request->session()->flash('message', '<div class="alert alert-success" role="alert">Nilai perbandingan : TIDAK KONSISTEN</div>');
            }
        }

        $result = array();
        $i = 0;
        foreach ($data['kriteria'] as $row1) {
            $ii = 0;
            foreach ($data['kriteria'] as $row2) {
                if ($i < $ii) {
                    $kriteria_ahp = KriteriaModel::get_kriteria_ahp($row1->id_kriteria, $row2->id_kriteria);
                    if (empty($kriteria_ahp)) {
                        $params = array(
                            'id_kriteria_1' => $row1->id_kriteria,
                            'id_kriteria_2' => $row2->id_kriteria,
                            'nilai_1' => 1,
                            'nilai_2' => 1,
                        );
                        KriteriaModel::add_kriteria_ahp($params);
                        $nilai_1 = 1;
                        $nilai_2 = 1;
                    } else {
                        $nilai_1 = $kriteria_ahp->nilai_1;
                        $nilai_2 = $kriteria_ahp->nilai_2;
                    }
                    $nilai = 0;
                    if ($nilai_1 < 1) {
                        $nilai = $nilai_2;
                    } elseif ($nilai_1 > 1) {
                        $nilai = -$nilai_1;
                    } elseif ($nilai_1 == 1) {
                        $nilai = 1;
                    }
                    $result[$row1->id_kriteria][$row2->id_kriteria] = $nilai;
                }
                $ii++;
            }
            $i++;
        }

        $data['kriteria_ahp'] = $result;
        return view('kriteria.ahp_kriteria', $data);
    }

    public function reset(Request $request)
    {
        KriteriaModel::delete_kriteria_ahp();
        $params = array(
            'bobot' => null,
        );
        KriteriaModel::update_prioritas($params);
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil direset!</div>');
        return redirect()->route('ahp_kriteria');
    }
		
    
    public function ahp_get_matrik_kriteria($kriteria)
    {
        $matrik = array();
        $i = 0;
        foreach ($kriteria as $row1) {
            $ii = 0;
            foreach ($kriteria as $row2) {
                if ($i == $ii) {
                    $matrik[$i][$ii] = 1;
                } else {
                    if ($i < $ii) {
                        $kriteria_ahp = KriteriaModel::get_kriteria_ahp($row1, $row2);
                        if (empty($kriteria_ahp)) {
                            $matrik[$i][$ii] = 1;
                            $matrik[$ii][$i] = 1;
                        } else {
                            $matrik[$i][$ii] = $kriteria_ahp->nilai_1;
                            $matrik[$ii][$i] = $kriteria_ahp->nilai_2;
                        }
                    }
                }
                $ii++;
            }
            $i++;
        }
        return $matrik;
    }

    public function ahp_get_jumlah_kolom($matrik)
    {
        $jumlah_kolom = array();
        for ($i = 0; $i < count($matrik); $i++) {
            $jumlah_kolom[$i] = 0;
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $jumlah_kolom[$i] = $jumlah_kolom[$i] + $matrik[$ii][$i];
            }
        }
        return $jumlah_kolom;
    }

    public function ahp_get_normalisasi($matrik, $jumlah_kolom)
    {
        $matrik_normalisasi = array();
        for ($i = 0; $i < count($matrik); $i++) {
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $matrik_normalisasi[$i][$ii] = $matrik[$i][$ii] / $jumlah_kolom[$ii];
            }
        }
        return $matrik_normalisasi;
    }

    public function ahp_get_prioritas($matrik_normalisasi)
    {
        $prioritas = array();
        for ($i = 0; $i < count($matrik_normalisasi); $i++) {
            $prioritas[$i] = 0;
            for ($ii = 0; $ii < count($matrik_normalisasi); $ii++) {
                $prioritas[$i] = $prioritas[$i] + $matrik_normalisasi[$i][$ii];
            }
            $prioritas[$i] = $prioritas[$i] / count($matrik_normalisasi);
        }
        return $prioritas;
    }

    public function ahp_get_matrik_baris($prioritas, $matrik_kriteria)
    {
        $matrik_baris = array();
        for ($i = 0; $i < count($matrik_kriteria); $i++) {
            for ($ii = 0; $ii < count($matrik_kriteria); $ii++) {
                $matrik_baris[$i][$ii] = $prioritas[$ii] * $matrik_kriteria[$i][$ii];
            }
        }
        return $matrik_baris;
    }

    public function ahp_get_jumlah_matrik_baris($matrik_baris)
    {
        $jumlah_baris = array();
        for ($i = 0; $i < count($matrik_baris); $i++) {
            $jumlah_baris[$i] = 0;
            for ($ii = 0; $ii < count($matrik_baris); $ii++) {
                $jumlah_baris[$i] = $jumlah_baris[$i] + $matrik_baris[$i][$ii];
            }
        }
        return $jumlah_baris;
    }

    public function ahp_get_tabel_konsistensi($jumlah_matrik_baris, $prioritas)
    {
        $jumlah = array();
        for ($i = 0; $i < count($jumlah_matrik_baris); $i++) {
            $jumlah[$i] = $jumlah_matrik_baris[$i] + $prioritas[$i];
        }
        return $jumlah;
    }

    public function ahp_uji_konsistensi($tabel_konsistensi)
    {
        $jumlah = array_sum($tabel_konsistensi);
        $n = count($tabel_konsistensi);
        $lambda_maks = $jumlah / $n;
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
        if ($n <= 15) {
            $ir = $ir[$n - 1];
        } else {
            $ir = $ir[14];
        }
        $cr = $ci / $ir;

        if ($cr <= 0.1) {
            return true;
        } else {
            return false;
        }
    }
    
    public function tampil_data_1($matrik_kriteria, $jumlah_kolom)
    {
        $kriteria = KriteriaModel::get_all_kriteria();
        $list_data = '';
        $list_data .= '<trclass="text-center"><td></td>';
        foreach ($kriteria as $row) {
            $list_data .= '<td class="text-center">' . $row->kode_kriteria . '</td>';
        }
        $list_data .= '</tr>';
        $i = 0;
        foreach ($kriteria as $row) {
            $list_data .= '<tr class="text-center">';
            $list_data .= '<td>' . $row->kode_kriteria . '</td>';
            $ii = 0;
            foreach ($kriteria as $row2) {
                $list_data .= '<td class="text-center">' . $matrik_kriteria[$i][$ii] . '</td>';
                $ii++;
            }
            $list_data .= '</tr>';
            $i++;
        }
        $list_data .= '<tr class="text-center"><td class="font-weight-bold">Jumlah</td>';
        for ($i = 0; $i < count($jumlah_kolom); $i++) {
            $list_data .= '<td class="text-center font-weight-bold">' . $jumlah_kolom[$i] . '</td>';
        }
        $list_data .= '</tr>';
        return $list_data;
    }

    public function tampil_data_2($matrik_normalisasi, $prioritas)
    {
        $kriteria = KriteriaModel::get_all_kriteria();
        $list_data2 = '';
        $list_data2 .= '<tr class="text-center"><td></td>';
        foreach ($kriteria as $row) {
            $list_data2 .= '<td class="text-center">' . $row->kode_kriteria . '</td>';
        }
        $list_data2 .= '<td class="text-center font-weight-bold">Jumlah</td>';
        $list_data2 .= '<td class="text-center font-weight-bold">Prioritas</td>';
        $list_data2 .= '</tr>';
        $i = 0;
        foreach ($kriteria as $row) {
            $list_data2 .= '<tr class="text-center">';
            $list_data2 .= '<td>' . $row->kode_kriteria . '</td>';
            $jumlah = 0;
            $ii = 0;
            foreach ($kriteria as $row2) {
                $list_data2 .= '<td class="text-center">' . $matrik_normalisasi[$i][$ii] . '</td>';
                $jumlah += $matrik_normalisasi[$i][$ii];
                $ii++;
            }
            $list_data2 .= '<td class="text-center font-weight-bold">' . $jumlah . '</td>';
            $list_data2 .= '<td class="text-center font-weight-bold">' . $prioritas[$i] . '</td>';
            $list_data2 .= '</tr>';
            $i++;
        }
        return $list_data2;
    }

    public function tampil_data_3($matrik_baris, $jumlah_matrik_baris)
    {
        $kriteria = KriteriaModel::get_all_kriteria();
        $list_data3 = '';
        $list_data3 .= '<tr class="text-center"><td></td>';
        foreach ($kriteria as $row) {
            $list_data3 .= '<td class="text-center">' . $row->kode_kriteria . '</td>';
        }
        $list_data3 .= '<td class="text-center font-weight-bold">CM</td>';
        $list_data3 .= '</tr>';
        $i = 0;
        foreach ($kriteria as $row) {
            $list_data3 .= '<tr class="text-center">';
            $list_data3 .= '<td>' . $row->kode_kriteria . '</td>';
            $ii = 0;
            foreach ($kriteria as $row2) {
                $list_data3 .= '<td class="text-center">' . $matrik_baris[$i][$ii] . '</td>';
                $ii++;
            }
            $list_data3 .= '<td class="text-center font-weight-bold">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data3 .= '</tr>';
            $i++;
        }
        return $list_data3;
    }

    public function tampil_data_4($jumlah_matrik_baris, $prioritas, $hasil_tabel_konsistensi)
    {
        $kriteria = KriteriaModel::get_all_kriteria();
        $list_data4 = '';
        $list_data4 .= '<tr class="text-center"><td></td>';
        $list_data4 .= '<td class="text-center">CM</td>';
        $list_data4 .= '<td class="text-center">Prioritas</td>';
        $list_data4 .= '</tr>';
        $i = 0;
        foreach ($kriteria as $row) {
            $list_data4 .= '<tr class="text-center">';
            $list_data4 .= '<td>' . $row->kode_kriteria . '</td>';
            $list_data4 .= '<td class="text-center">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data4 .= '<td class="text-center">' . $prioritas[$i] . '</td>';
            $list_data4 .= '</tr>';
            $i++;
        }
        
        $n = count($jumlah_matrik_baris);
        $lambda_maks = array_sum($jumlah_matrik_baris);
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
        if ($n <= 15) {
            $ir = $ir[$n - 1];
        } else {
            $ir = $ir[14];
        }
        $cr = $ci / $ir;

        $list_data5 = '';
        $list_data5 .= '<table class="table">
        <tr>
            <td width="20%">n </td>
            <td>= ' . $n . '</td>
        </tr>
        <tr>
            <td>λ maks</td>
            <td>= ' . $lambda_maks . '</td>
        </tr>
        <tr>
            <td>Consistency Index (CI)</td>
            <td>= ' . $ci . '</td>
        </tr>
        <tr>
            <td>Consistency Ratio (CR)</td>
            <td>= ' . $cr . '</td>
        </tr>
        <tr>
            <td>CR <= 0.1</td>';
                if ($cr <= 0.1) {
                    $list_data5 .= '
            <td>Konsisten</td>';
                } else {
                    $list_data5 .= '
            <td>Tidak Konsisten</td>';
                }
                $list_data5 .= '
        </tr>
        </table>';
        return array($list_data4, $list_data5);
    }
}
