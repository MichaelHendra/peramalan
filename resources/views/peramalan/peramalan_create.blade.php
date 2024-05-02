@extends('template')
@section('title','Form Peramalan')
@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <strong class="card-title">Peramalan Penjualan</strong>
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
                                    <form action="{{ url('/peramalan/store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="Alpha">Kode Peramalan</label>
                                            <input type="text" name="id_perhitungan"
                                            class="form-control"
                                            value="{{$id}}" autofocus readonly>
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
                                            <label for="Tanggal">Tanggal</label>
                                            <input type="date" name="tanggal" value="{{$now}}" class="form-control" placeholder="{{$now}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="Alpha"> Nilai Alpha</label>
                                            <input type="text" name="alpha"
                                            class="form-control"
                                            value="" autofocus placeholder="Masukan Nilai Alpha">
                                        </div>
                                        <div class="form-group">
                                            <label for="Alpha"> Nilai Beta</label>
                                            <input type="text" name="beta"
                                            class="form-control"
                                            value="" autofocus placeholder="Maukan Nilai Beta">
                                        </div>
                                        <div class="form-group">
                                            <label for="Alpha"> Nilai Gamma</label>
                                            <input type="text" name="gamma"
                                            class="form-control"
                                            value="" autofocus placeholder="Masukan Nilai Gamma">
                                        </div>
                                        <div class="form-group">
                                            <label for="Alpha">Periode</label>
                                            <input type="text" name="season"
                                            class="form-control"
                                            value="" autofocus placeholder="Masukan Nilai season">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success" name="simpan"><i
                                                    class="fa fa-save"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                        {{-- <div class="form-group">
                                            <label for="jumlah_penjualan">Jumlah Penjualan</label>
                                            <div class="input-group margin-bottom-sm">
                                                <input type="text" name="jumlah_penjualan"
                                                    class="form-control @error('jumlah_penjualan') is-invalid @enderror"
                                                    value="" autofocus placeholder="Jumlah Penjualan">
                                                @error('jumlah_penjualan')
                                                    <div class="invalid-feedback"></div>
                                                @enderror
                                            </div>
                                        </div> --}}

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