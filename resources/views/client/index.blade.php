@extends('layouts.dashboard')

@section('title')
    List Client
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Client</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Client Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('client.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Clinet</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Kontak Client</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea  name="alamat" class="form-control" >{{ old('alamat') }}</textarea>
                                    <p class="text-danger">{{ $errors->first('alamat') }}</p>
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
                            <h4 class="card-title">List Client</h4>
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
                                            <th>Kontak Client</th>
                                            <th>Alamat</th>
                                            <th>Terdaftar</th>
                                            <th>Admin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      	
                                        @forelse ($client as $val)
                                        <tr>
                                            <td></td>
                                            <td><strong>{{ $val->name }}</strong></td>
                                            
                                            <td>{{ $val->phone }}</td>
                                            <td>{{ $val->alamat }}</td>
                                            <td>{{ $val->created_at }}</td>
                                            <td>{{ $val->user->name }}</td>
                                            <td>
                                                <form action="{{ route('client.destroy', $val->id) }}" method="post">
                                                   
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('client.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                       
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
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