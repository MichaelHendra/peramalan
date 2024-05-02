@extends('template')
@section('title', 'Produk Entry')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <strong class="card-title">Produk</strong>
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
                                        <form action="{{ url('/produk/store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="kode_produk">Produk</label>
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
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_produk">Nama Produk</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="text" name="nama_produk"
                                                        class="form-control @error('nama_produk') is-invalid @enderror"
                                                        value="{{ old('nama_produk') }}" autofocus placeholder="Nama Produk">
                                                    @error('nama_produk')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="harga_jual">Harga Penjualan</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="text" name="harga_jual"
                                                        class="form-control @error('harga_jual') is-invalid @enderror"
                                                        value="{{ old('harga_jual') }}" autofocus placeholder="Harga Penjualan">
                                                    @error('harga_jual')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- <div class="form-group">
                                                <label for="gambar">Gambar</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="file" name="gambar"
                                                        class="form-control @error('gambar') is-invalid @enderror"
                                                        value="{{ old('gambar') }}" >
                                                    @error('gambar')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> --}}

                                            <button type="submit" class="btn btn-success" name="simpan"><i
                                                    class="fa fa-save"></i> Save
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
    </div>
@endsection
