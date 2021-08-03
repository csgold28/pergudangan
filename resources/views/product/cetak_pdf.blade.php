<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN REKAPAN BARANG</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
        <h5>LAPORAN REKAPAN BARANG</h4><br>
        <span>Dicetak Tanggal : {{ date('d-m-Y') }}</span>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th>Total</th>
				<th>Ready</th>
				<th>Terpakai</th>
                <th>Rusak</th>
                <th>Terjual</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($product as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->name}}</td>
				<td>{{number_format($p->productdetail->count() -  $p->productdetail->where('status',4)->count(), 0, ',', '.')}}</td>
				<td>{{number_format($p->productdetail->where('status',1)->count(), 0, ',', '.')}}</td>
				<td>{{number_format($p->productdetail->where('status',2)->count(), 0, ',', '.')}}</td>
                <td>{{number_format($p->productdetail->where('status',3)->count(), 0, ',', '.')}}</td>
                <td>{{number_format($p->productdetail->where('status',4)->count(), 0, ',', '.')}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>