@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
	<?php
    if(count($hasil) > 0){
    ?>
    <a href="{{ url('Laporan') }}/<?= $kategori ?>" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
    <?php } ?>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Pilih Kategori Pakan</h6>
    </div>

    <div class="card-body">
		<select class="form-control" onchange="location = this.value;">
			<option value="">--Pilih--</option>
            <option value="{{ url('') }}/Hasil/kategori/1" <?php if($kategori == 1){echo "selected";} ?>>Pre-Starter</option>
            <option value="{{ url('') }}/Hasil/kategori/2" <?php if($kategori == 2){echo "selected";} ?>>Starter</option>
            <option value="{{ url('') }}/Hasil/kategori/3" <?php if($kategori == 3){echo "selected";} ?>>Finisher</option>
		</select>
	</div>
</div>

<?php
if(count($hasil) <= 0){
    echo "<div class='alert alert-danger text-center'>Data hasil masih kosong</div>";
}else{
?>
<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-info text-white">
                    <tr align="center">
                        <th>Nama Alternatif</th>
                        <th>Nilai</th>
                        <th width="15%">Ranking</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($hasil as $keys)
                    <tr align="center">
                        <td align="left">{{ $keys->nama }}</td>
                        <td>{{ $keys->nilai }}</td>
                        <td>{{ $no }}</td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>
@include('layouts.footer_admin')
