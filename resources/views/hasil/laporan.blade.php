<!DOCTYPE html>
<html>
<head>
	<title>Sistem Pendukung Keputusan Metode AHP TOPSIS</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
</style>
<body>
<?php
if(count($hasil) <= 0){
    echo "<div class='alert alert-danger text-center'>Data hasil masih kosong</div>";
}else{
?>
<center>
<h4>Hasil Akhir Perankingan Kategori 
    <?php
    if ($kategori == 1) {
        echo 'Pre-Starter';
    } elseif ($kategori == 2) {
        echo 'Starter';
    } elseif ($kategori == 3) {
        echo 'Finisher';
    } else {
        echo '-';
    }
    ?>
</h4>
</center>
<table border="1" width="100%">
	<thead>
		<tr align="center">
			<th>Alternatif</th>
			<th width="15%">Nilai</th>
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
<script>
	window.print();
</script>
<?php } ?>
</body>
</html>