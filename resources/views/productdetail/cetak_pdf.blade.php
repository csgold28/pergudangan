<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN REKAPAN UNIT</title>
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
        <h5>LAPORAN REKAPAN UNIT</h4><br>
        <span>Dicetak Tanggal : {{ date('d-m-Y') }}</span>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th>Barcode</th>
				<th>Serial Number</th>
				<th>Status</th>
                <th>Status Barang</th>
                <th>Suplayer</th>
                <th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($produkdetail as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->product->name}}</td>
                <td>{{ $p->barcode }}</td>
                <td>{{ $p->serial_number }}</td>
                <td>
                    @if ($p->status == 1)
                        READY
                    @elseif($p->status == 2)
                        TERPAKAI
                    @elseif($p->status == 4)
                        TERJUAL
                    @else
                        RUSAK
                    @endif

                </td>
                <td>
                    @if ($p->status_barang == 1)
                        Milik Sendiri
                    @elseif($p->status_barang == 2)
                        Sewa
                    @endif

                </td>
                <td>{{ $p->suplayer->name }}</td>
                <td>{{ $p->keterangan }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
