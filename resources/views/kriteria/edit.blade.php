@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>

    <a href="{{ url('Kriteria') }}" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-edit"></i> Edit Data Kriteria</h6>
    </div>

    <form method="POST" action="{{ url('Kriteria/update/'.$kriteria->id_kriteria) }}">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="id_kriteria" value="{{ $kriteria->id_kriteria }}">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Kode Kriteria</label>
                    <input autocomplete="off" type="text" name="kode_kriteria" value="{{ $kriteria->kode_kriteria }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Kriteria</label>
                    <input autocomplete="off" type="text" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-4">
					<label class="font-weight-bold">Jenis Kriteria</label>
					<select name="jenis" class="form-control" required>
						<option value="Benefit" <?php if($kriteria->jenis == "Benefit"){ echo 'selected'; } ?>>Benefit</option>
						<option value="Cost" <?php if($kriteria->jenis == "Cost"){ echo 'selected'; } ?>>Cost</option>						
					</select>
				</div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
    </form>

</div>

@include('layouts.footer_admin')
