@extends('template')
@section('title', 'Kotabaru Entry')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <strong class="card-title">Penjualan Kotabaru</strong>
                            </div>
                            <div class="pull-right">
                                <a href=" {{ url('/kotabaru') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-undo"></i>Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 offset-md-4">
                                        <form action="{{ url('/kotabaru/store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="kode_penjualan">Kode Penjualan</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="text" name="kode_penjualan"
                                                        class="form-control @error('kode_penjualan') is-invalid @enderror"
                                                        value="{{ $kodeOtomatis }}"
                                                        placeholder="Kode produk"
                                                        readonly>
                                                    @error('kode_penjualan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <label for="id_produk">Nama Produk</label>
                                            <div class="input-group margin-bottom-sm">
                                                <select name="id_produk" class="form-control @error('id_produk') is-invalid @enderror">
                                                    <option value="">Pilih Produk</option>
                                                    @foreach($produkList as $produk)
                                                        <option value="{{ $produk->id_produk }}">{{ $produk->nama_produk }}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_produk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                            <div class="form-group">
                                                <label for="jumlah_penjualan">Jumlah Penjualan</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="text" name="jumlah_penjualan"
                                                        class="form-control @error('jumlah_penjualan') is-invalid @enderror"
                                                        value="{{ old('jumlah_penjualan') }}" autofocus placeholder="Jumlah Penjualan">
                                                    @error('jumlah_penjualan')
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
