@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Level</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Level</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            <div class="row">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">Manage Level</div>
                    <div class="card-body">
                        <a href="{{ route('level.create') }}" class="btn btn-primary btn-block btn-sm"
                            style="width:100px!important;margin-left: 850px!important;padding:5px;font-sixe:15pz">
                            Tambah
                        </a>
                        <table border="1" cellpadding="2" cellspacing="0" class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Level Kode</th>
                                <th>Nama Level</th>
                            </tr>
                            @foreach($data as $d)
                            <tr>
                                <td>{{$d->level_id}}</td>
                                <td>{{$d->level_kode}}</td>
                                <td>{{$d->level_nama}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    {{-- @endsection --}}

    @push('scripts')
        {{-- {{ $dataTable->scripts() }} --}}
    @endpush

