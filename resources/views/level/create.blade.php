@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('level.store') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label for="kodelevel">Kode Level</label>
                        <input type="text" class="form-control" id="level_kode" name="level_kode"
                            placeholder="Isi kodemu...">
                        @error('level_kode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="namalevel">Nama Level</label>
                    <input type="text" class="form-control" id="level_nama" name="level_nama"
                        placeholder="Isi namamu...">
                    @error('level_nama')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush


