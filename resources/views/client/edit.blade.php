@extends('layouts.dashboard')

@section('title')
    Edit Client
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Client</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Client</h4>
                        </div>
                        <div class="card-body">
                          	
                            <form action="{{ route('client.update', $client->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                 
                                <div class="form-group">
                                    <label for="name">Nama Clinet</label>
                                    <input type="text" name="name" class="form-control" value="{{ $client->name }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Kontak Client</label>
                                    <input type="text" name="phone" class="form-control" value="{{$client->phone }}">
                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea  name="alamat" class="form-control" >{{ $client->alamat }}</textarea>
                                    <p class="text-danger">{{ $errors->first('alamat') }}</p>
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