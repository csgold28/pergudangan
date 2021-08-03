@extends('layouts.dashboard')

@section('title')
    List Barang
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Barang</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Barang Baru</h4>
                            
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Barang</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Kategori</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($parent as $row)
                                        @if (old('parent_id') == $row->id)
                                            <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                        @else
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('parent_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List Barang
                                <a href="{{ route('cetak.laporan') }}" class="btn btn-danger btn-sm float-right">Cetak PDF</a> 
                                <a href="{{ route('productdetail.index') }}" class="btn btn-primary btn-sm float-right">List Unit</a>
                            </h4>
                            <span class="badge badge-danger">NB : Jumlah TERJUAL tidak termasuk dalam jumlah TOTAL.</span>
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
                                            <th>Kategori</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      	
                                        @forelse ($product as $val)
                                        <tr>
                                            <td></td>
                                            <td><strong>{{ $val->name }}</strong>
                                                
                                            </td>
                                            <td>{{ $val->category->name }}</td>
                                            <td>{{ $val->created_at }}</td>
                                            <td>
                                                <label><strong> Total : {{ number_format($val->productdetail->count() -  $val->productdetail->where('status',4)->count(), 0, ',', '.')}}</strong></label><br>
                                                <label>Ready: <span class="badge badge-success">{{ number_format($val->productdetail->where('status',1)->count(), 0, ',', '.') }}</span></label> <br>
                                                <label>Terpakai: <span class="badge badge-warning">{{ number_format($val->productdetail->where('status',2)->count(), 0, ',', '.') }}</span></label><br>
                                                <label>Rusak: <span class="badge badge-danger">{{ number_format($val->productdetail->where('status',3)->count(), 0, ',', '.') }}</span></label><br>
                                                <label>Terjual: <span class="badge badge-info">{{ number_format($val->productdetail->where('status',4)->count(), 0, ',', '.') }}</span></label><br>
                                            </td>
                                            <td>
                                              
                                               
                                                <form action="{{ route('product.destroy', $val->id) }}" method="post">
                                                   
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('product.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                       
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
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