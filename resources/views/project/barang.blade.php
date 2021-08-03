@extends('layouts.dashboard')

@section('title')
    List Unit
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Unit</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Unit</h4>
                            
                        </div>
                        <div class="card-body">
                            <form action="{{ route('projectbarang.store',$project->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="product_id">Nama Barang</label>
                                    <select name="product_id" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($product as $row)
                                            @if (old('product_id') == $row->id)
                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                            @else
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('product_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Unit</label>
                                    <input type="number" name="jumlah" class="form-control">
                                    <p class="text-danger">{{ $errors->first('jumlah') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List UNIT : {{ $project->client->name }}
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
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th style="width: 15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      	
                                        @forelse ($projectbarang as $val)
                                        <tr>
                                            <td></td>
                                            <td><strong>{{ $val->product->name }}</strong>
                                                
                                            </td>
                                            <td>{{ $val->jumlah }}</td>
                                            <td>
                                                @if ($val->status == 1)
                                                    <span class="badge badge-warning">Belum Proses</span>
                                                @else
                                                    <span class="badge badge-success">Ready</span>
                                                @endif
                                            </td>
                                            <td>
                                              
                                                <form action="{{ route('projectbarang.destroy', $val->id) }}" method="post">
                                                   
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('projectbarang.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                       
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>
                
            </div>
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