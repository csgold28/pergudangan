@extends('layouts.dashboard')

@section('title')
    List Suplayer
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Suplayer</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Suplayer Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('suplayer.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Suplayer</label>
                                    <input type="text" name="name" class="form-control" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
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
                            <h4 class="card-title">List Suplayer</h4>
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
                                            <th>Suplayer</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      	
                                        @forelse ($suplayer as $val)
                                        <tr>
                                            <td></td>
                                            <td><strong>{{ $val->name }}</strong></td>
                                    
                                            <td>{{ $val->created_at }}</td>
                                            <td>
                                              
                                               
                                                <form action="{{ route('suplayer.destroy', $val->id) }}" method="post">
                                                   
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('suplayer.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                       
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
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