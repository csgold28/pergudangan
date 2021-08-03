@extends('layouts.dashboard')

@section('title')
    List Project
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Project</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            {{-- <div class="row"> --}}
                <div class="col-md-20">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List Project
                                <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm float-right">Buat Project</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Client</th>
                                            <th>Sales</th>
                                            <th>Nominal</th>
                                            <th>Tanggal</th>
                                            <th>Transaksi</th>
                                            <th>Status Barang</th>
                                            <th>Teknisi</th>
                                            <th style="width: 11%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      	
                                        @forelse ($project as $val)
                                        <tr>
                                            <td></td>
                                            <td><strong>{{ $val->client->name }}</strong><br>
                                                <label>Kontak : {{ $val->client->phone }}</label><br>
                                                <label>Alamat : {{ $val->client->alamat }}</label>
                                            </td>
                                            <td>
                                                {{ $val->user->name }}
                                            </td>
                                            <td>
                                                <label><strong> Nominal : {{ number_format($val->nominal, 0, ',', '.')}}</strong></label><br>
                                                <label>DP: <span class="badge badge-success">{{ number_format($val->dp, 0, ',', '.') }}</span></label> <br>
                                                <label>Sisa: @if ($val->status_pembayaran == 2)
                                                    <span class="badge badge-warning">0</span>
                                                @else
                                                <span class="badge badge-warning">{{ number_format($val->nominal - $val->dp, 0, ',', '.') }}</span></label><br>
                                                
                                                @endif
                                               
                                            </td>
                                            <td>
                                                <label>Dibuat : {{ $val->created_at }}</label><br>
                                                <label>Waktu Sewa: {{ $val->waktu_sewa }} </label><br>
                                                
                                            </td>
                                            <td>
                                                <label><strong> Transaksi : {{ $val->tipe_transaksi }}</strong></label><br>
                                                <label>No. Kontrak: {{ $val->no_kontrak }} </label><br>
                                                <label>Status Bayar: 
                                                    @if ($val->status_pembayaran == 1)
                                                        <span class="badge badge-warning">Belum Lunas</span></label>
                                                    @else
                                                        <span class="badge badge-success">Sudah Lunas</span></label>
                                                    @endif
                                                    </label><br>
                                                <label>Ket. Bayar: {{ $val->keterangan_pembayaran }} </label><br>
                                            </td>
                                            <td>
                                                @if ($val->status_barang == 1)
                                                    <span class="badge badge-warning">Belum Diproses</span></label><br><br>
                                                @else
                                                    <span class="badge badge-success">Sudah Kembali</span></label><br><br>
                                                @endif
                                                <a href="{{ route('project.show', $val->id) }}" class="btn btn-info">List Barang</a>
                                            </td>
                                            <td>
                                                <label> Loading : @if ($val->teknisiloading_id == true)
                                                    {{ $val->teknisiloading_id }}
                                                @else
                                                    -
                                                @endif</label><br>
                                                <label> Bongkar : @if ($val->teknisibongkar_id == true)
                                                    {{ $val->teknisibongkar_id }}
                                                @else
                                                    -
                                                @endif</label><br>
                                            </td>
                                            <td>
                                               
                                                <form action="{{ route('project.destroy', $val->id) }}" method="post">
                                                   
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('project.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                       
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>
                
            {{-- </div> --}}
        </div>
    </div>
</main>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endsection