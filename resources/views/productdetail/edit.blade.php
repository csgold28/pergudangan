@extends('layouts.dashboard')

@section('title')
    Edit Unit
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Unit</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Unit</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('productdetail.update', $produkdetail->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="product">Nama Barang</label>
                                    <select name="product" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($product as $row)
                                        <option value="{{ $row->id }}" {{ $produkdetail->product_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('product') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" name="barcode" class="form-control" value="{{ $produkdetail->barcode }}">
                                    <p class="text-danger">{{ $errors->first('barcode') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="serial_number">Serial Number</label>
                                    <input type="text" name="serial_number" class="form-control" value="{{ $produkdetail->serial_number }}">
                                    <p class="text-danger">{{ $errors->first('serial_number') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">None</option>
                                        <option value="1" @if ($produkdetail->status == 1) selected  @endif>Ready</option>
                                        <option value="2" @if ($produkdetail->status == 2) selected  @endif>Terpakai</option>
                                        <option value="3" @if ($produkdetail->status == 3) selected  @endif>Rusak</option>
                                        <option value="4" @if ($produkdetail->status == 4) selected  @endif>Terjual</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status Barang</label>
                                    <select name="status_barang" class="form-control">
                                        <option value="">None</option>
                                        <option value="1" @if ($produkdetail->status_barang == 1) selected  @endif>Milik Sendiri</option>
                                        <option value="2" @if ($produkdetail->status_barang == 2) selected  @endif>Sewa</option>
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
                                        <option value="{{ $sup->id }}" {{ $produkdetail->suplayer_id == $sup->id ? 'selected':'' }}>{{ $sup->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('suplayer') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" class="form-control">{{ $produkdetail->keterangan }}</textarea>
                                    <p class="text-danger">{{ $errors->first('keterangan') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
