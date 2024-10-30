@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Edit Kategori</h5>
            </div>

            <form method="POST" action="{{ route('kategori.update', ['id' => $data->id ]) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="kategori_kode">Kode Kategori</label>
                    <input type="text" class="form-control" id="kategori_kode" name="kategori_kode"
                        value="{{ $data->kategori_kode }}">
                </div>
                <div class="form-group">
                    <label for="kategori_nama">Nama Kategori</label>
                    <input type="text" class="form-control" id="kategori_nama" name="kategori_nama"
                        value="{{ $data->kategori_nama }}">
                </div>

                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </form>
        </div>
    </div>
@endsection
