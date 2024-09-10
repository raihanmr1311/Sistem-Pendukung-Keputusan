@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan</h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Pilih Kategori Pakan</h6>
    </div>

    <div class="card-body">
		<select class="form-control" onchange="location = this.value;">
			<option value="">--Pilih--</option>
            <option value="{{ url('') }}/Perhitungan/kategori/1">Pre-Starter</option>
            <option value="{{ url('') }}/Perhitungan/kategori/2">Starter</option>
            <option value="{{ url('') }}/Perhitungan/kategori/3">Finisher</option>
		</select>
	</div>
</div>

@include('layouts.footer_admin')


