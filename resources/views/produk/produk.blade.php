@extends('template')
@section('title', 'Produk')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <strong class="card-title">Produk Roti</strong>
                            </div>
                            <div class="pull-right">
                                <a href="/produk/tambah" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                                <a href="/produk/cetak" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-print"></i> Print
                                </a>
                               
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Produk</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Harga Jual</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produk as $item)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{ $item->kode_produk }}</td>
                                                <td>{{ $item->nama_produk }}</td>
                                                <td>{{ $item->harga_jual }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="/produk/edit/{{ $item->id_produk }}" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a href="/produk/delete/{{ $item->id_produk }}" class="btn btn-danger btn-sm" style="margin-left: 5px;">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- {{ $pesan->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
