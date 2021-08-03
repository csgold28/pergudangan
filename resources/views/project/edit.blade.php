@extends('layouts.dashboard')

@section('title')
    Edit Project
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Edit Project</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="col-md-20">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Project</h4>
                        
                    </div>
                    <div class="card-body">
                        <form action="{{ route('project.update',$project->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="client_id">Nama Client</label>
                                        <select name="client_id" class="form-control">
                                            <option value="">None</option>
                                            @foreach ($client as $row)
                                                <option value="{{ $row->id }}" {{ $project->client_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('client_id') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="nominal">Nominal</label>
                                        <input type="number" name="nominal" class="form-control" value="{{ $project->nominal }}">
                                        <p class="text-danger">{{ $errors->first('nominal') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="dp">DP</label>
                                        <input type="number" name="dp" class="form-control" value="{{ $project->dp }}">
                                        <p class="text-danger">{{ $errors->first('dp') }}</p>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="sisa">Sisa Bayar</label>
                                        <input type="number" name="sisa" class="form-control" value="{{ $project->sisa }}">
                                        <p class="text-danger">{{ $errors->first('sisa') }}</p>
                                    </div> --}}
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="waktu_sewa">Waktu Sewa (Cth 1 Hari / 1 Bulan)</label>
                                        <input type="text" name="waktu_sewa" class="form-control" value="{{ $project->waktu_sewa }}">
                                        <p class="text-danger">{{ $errors->first('waktu_sewa') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipe_transaksi">Tipe Transaksi (Cth Sewa Laptop )</label>
                                        <input type="text" name="tipe_transaksi" class="form-control" value="{{ $project->tipe_transaksi }}">
                                        <p class="text-danger">{{ $errors->first('tipe_transaksi') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_kontrak">No. Kontrak</label>
                                        <input type="text" name="no_kontrak" class="form-control" value="{{ $project->no_kontrak }}">
                                        <p class="text-danger">{{ $errors->first('no_kontrak') }}</p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="status_pembayaran">Status</label>
                                        <select name="status_pembayaran" class="form-control">
                                            <option value="">None</option>
                                            <option value="1" @if ($project->status_pembayaran == 1) selected  @endif>Belum Lunas</option>
                                            <option value="2" @if ($project->status_pembayaran == 2) selected  @endif>Lunas</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('status_pembayaran') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="keterangan_pembayaran">Keterangan Bayar ( cth BCA Tanggal {{ date('d-M-Y') }})</label>
                                        <input type="text" name="keterangan_pembayaran" class="form-control" value="{{ $project->keterangan_pembayaran }}">
                                        <p class="text-danger">{{ $errors->first('keterangan_pembayaran') }}</p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="teknisiloading_id">Teknisi Loading</label>
                                        <input type="text" name="teknisiloading_id" class="form-control" value="{{ $project->teknisiloading_id }}">
                                        <p class="text-danger">{{ $errors->first('teknisiloading_id') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="teknisibongkar_id">Teknisi Bongkaran</label>
                                        <input type="text" name="teknisibongkar_id" class="form-control" value="{{ $project->teknisibongkar_id }}">
                                        <p class="text-danger">{{ $errors->first('teknisibongkar_id') }}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <button class="btn btn-warning float-right">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
                
    </div>
       
</main>
@endsection