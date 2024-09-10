@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Data Penilaian</h1>
</div>

{!! session('message') !!}

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Pilih Kategori Pakan</h6>
    </div>

    <div class="card-body">
		<select class="form-control" onchange="location = this.value;">
			<option value="">--Pilih--</option>
            <option value="{{ url('') }}/Penilaian/kategori/1" <?php if($kategori == 1){echo "selected";} ?>>Pre-Starter</option>
            <option value="{{ url('') }}/Penilaian/kategori/2" <?php if($kategori == 2){echo "selected";} ?>>Starter</option>
            <option value="{{ url('') }}/Penilaian/kategori/3" <?php if($kategori == 3){echo "selected";} ?>>Finisher</option>
		</select>
	</div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Daftar Data Penilaian</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-info text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Alternatif</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($alternatif as $keys)
                    <tr align="center">
                        <td>{{ $no }}</td>
                        <td align="left">{{ $keys->nama }}</td>
                        <?php $cek_tombol = \App\Models\PenilaianModel::untuk_tombol($keys->id_alternatif); ?>

                        <td>
                            @if ($cek_tombol == 0)
                            <a data-toggle="modal" href="#set{{ $keys->id_alternatif }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Input</a>
                            @else
                            <a data-toggle="modal" href="#edit{{ $keys->id_alternatif }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="set{{ $keys->id_alternatif }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Input Penilaian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="{{ url('Penilaian/tambah') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        @foreach ($kriteria as $key)
                                            @php
                                            $sub_kriteria = \App\Models\SubKriteriaModel::data_sub_kriteria($key->id_kriteria);
                                            @endphp
                                            @if ($sub_kriteria != NULL)
                                                <input type="hidden" name="id_alternatif" value="{{ $keys->id_alternatif }}">
                                                <input type="hidden" name="id_kriteria[]" value="{{ $key->id_kriteria }}">
                                                <input type="hidden" name="kategori" value="{{ $kategori }}">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="{{ $key->id_kriteria }}">{{ $key->nama_kriteria }}</label>
                                                    <select name="id_sub_kriteria[]" class="form-control" id="{{ $key->id_kriteria }}" required>
                                                        <option value="">--Pilih--</option>
                                                        @foreach ($sub_kriteria as $subs_kriteria)
                                                            <option value="{{ $subs_kriteria['id_sub_kriteria'] }}">{{ $subs_kriteria['nama_sub_kriteria'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="edit{{ $keys->id_alternatif }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Penilaian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="{{ url('Penilaian/edit') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        @foreach ($kriteria as $key)
                                            @php
                                            $sub_kriteria = \App\Models\SubKriteriaModel::data_sub_kriteria($key->id_kriteria);
                                            @endphp
                                            @if ($sub_kriteria != NULL)
                                                <input type="hidden" name="id_alternatif" value="{{ $keys->id_alternatif }}">
                                                <input type="hidden" name="id_kriteria[]" value="{{ $key->id_kriteria }}">
                                                <input type="hidden" name="kategori" value="{{ $kategori }}">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="{{ $key->id_kriteria }}">{{ $key->nama_kriteria }}</label>
                                                    <select name="id_sub_kriteria[]" class="form-control" id="{{ $key->id_kriteria }}" required>
                                                        <option value="">--Pilih--</option>
                                                        @foreach ($sub_kriteria as $subs_kriteria)
                                                            @php
                                                            $id_sub_kriteria = \App\Models\PenilaianModel::data_penilaian($keys->id_alternatif, $subs_kriteria['id_kriteria']);
                                                            @endphp
                                                            <option value="{{ $subs_kriteria['id_sub_kriteria'] }}" {{ isset($subs_kriteria['id_sub_kriteria']) && $id_sub_kriteria && $subs_kriteria['id_sub_kriteria'] == $id_sub_kriteria->id_sub_kriteria ? 'selected' : '' }}>{{ $subs_kriteria['nama_sub_kriteria'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $no++;
                    ?>
				    @endforeach
			</tbody>
		</table>
	</div>
</div>

@include('layouts.footer_admin')


