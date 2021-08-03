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
                            <h4 class="card-title">Unit Baru</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('productdetail.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="product">Nama Barang</label>
                                    <select name="product" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($product as $row)
                                            @if (old('product') == $row->id)
                                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                            @else
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('product') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" name="barcode" class="form-control" value="{{ old('barcode') }}">
                                    <p class="text-danger">{{ $errors->first('barcode') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="serial_number">Serial Number</label>
                                    <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number') }}">
                                    <p class="text-danger">{{ $errors->first('serial_number') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">None</option>
                                        <option value="1" @if (old('status') == 1) selected  @endif>Ready</option>
                                        <option value="2" @if (old('status') == 2) selected  @endif>Terpakai</option>
                                        <option value="3" @if (old('status') == 3) selected  @endif>Rusak</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status Barang</label>
                                    <select name="status_barang" class="form-control">
                                        <option value="">None</option>
                                        <option value="1" @if (old('status_barang') == 1) selected  @endif>Milik Sendiri</option>
                                        <option value="2" @if (old('status_barang') == 2) selected  @endif>Sewa</option>

                                    </select>
                                    <p class="text-danger">{{ $errors->first('status_barang') }}</p>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="project">Pilih Projek (Jika status terpakai)</label>
                                    <select name="project" class="form-control">
                                        <option value="">None</option>

                                    </select>
                                    <p class="text-danger">{{ $errors->first('project') }}</p>
                                </div> --}}
                                <div class="form-group">
                                    <label for="suplayer">Suplayer</label>
                                    <select name="suplayer" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($suplayer as $sup)
                                        @if (old('suplayer') == $sup->id)
                                            <option value="{{ $sup->id }}" selected>{{ $sup->name }}</option>
                                        @else
                                            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('suplayer') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                                    <p class="text-danger">{{ $errors->first('keterangan') }}</p>
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
                            <h4 class="card-title">List UNIT
                                <a href="{{ route('cetak.unit') }}" class="btn btn-danger btn-sm float-right">Cetak PDF</a>
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
                                            <th>Barcode</th>
                                            <th>Serial Number</th>
                                            <th>Status</th>
                                            <th>Status Barang</th>
                                            <th>Suplayer</th>
                                            <th>Keterangan</th>
                                            <th style="width: 15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($produkdetail as $val)
                                        <tr>
                                            <td></td>
                                            <td><strong>{{ $val->product->name }}</strong>

                                            </td>
                                            <td>{{ $val->barcode }}</td>
                                            <td>{{ $val->serial_number }}</td>
                                            <td>
                                                @if ($val->status == 1)
                                                    <span class="badge badge-success">Ready</span>
                                                @elseif($val->status == 2)
                                                    <span class="badge badge-warning">Terpakai</span>
                                                @elseif($val->status == 4)
                                                    <span class="badge badge-info">Terjual</span>
                                                @else
                                                    <span class="badge badge-danger">Rusak</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($val->status_barang == 1)
                                                    <span class="badge badge-success">Milik Sendiri</span>
                                                @elseif($val->status_barang == 2)
                                                    <span class="badge badge-warning">Sewa</span>
                                                @endif

                                            </td>
                                            <td>{{ $val->suplayer->name }}</td>
                                            <td>{{ $val->keterangan }}</td>
                                            <td>

                                                <form action="{{ route('productdetail.destroy', $val->id) }}" method="post">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('productdetail.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
