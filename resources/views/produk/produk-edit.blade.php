@extends('template')
@section('title', 'Produk Edit')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <strong class="card-title">Produk Roti</strong>
                            </div>
                            <div class="pull-right">
                                <a href=" {{ url('/produk') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-undo"></i>Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 offset-md-4">
                                        <form action="{{ url('/produk/update/' . $produksi->id_produk) }}"
                                            method="post"  enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="id" value="">
                                            
                                            <div class="form-group">
                                                <label for="kode_produk">Kode Produk</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="text" name="kode_produk"
                                                        class="form-control @error('kode_produk') is-invalid @enderror"
                                                        value="{{ $kodeOtomatis }}"
                                                        placeholder="Kode produk"
                                                        readonly>
                                                    @error('kode_produk')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            <div class="form-group">
                                                <label for="nama_produk">Nama Produk</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="text" name="nama_produk"
                                                        class="form-control @error('nama_produk') is-invalid @enderror"
                                                        autofocus placeholder="Kode Produk"
                                                        value="{{ old('nama_produk', $produksi->nama_produk) }}" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="harga_jual">Harga Jual</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="text" name="harga_jual"
                                                        class="form-control @error('harga_jual') is-invalid @enderror"
                                                        autofocus placeholder="Harga Jual"
                                                        value="{{ old('harga_jual', $produksi->harga_jual) }}" />
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success" name="edit"><i
                                                class="fa fa-edit"></i> Edit
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
