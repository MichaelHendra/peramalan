@extends('template')
@section('title', 'Kotabaru Edit')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="pull-left">
                                <strong class="card-title">Penjualan Roti</strong>
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
                                        <form action="{{ url('/kotabaru/update/' . $penjualan->id_penjualan) }}"
                                            method="post"  enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="id" value="">
                                            
                                            <div class="form-group">
                                                <label for="kode_penjualan">Kode Penjualan</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="text" name="kode_penjualan"
                                                        class="form-control @error('kode_penjualan') is-invalid @enderror"
                                                        value="{{ $kodeOtomatis }}"
                                                        placeholder="Kode Penjualan"
                                                        readonly>
                                                    @error('kode_penjualan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="id_produk">Nama Produk</label>
                                                    <select class="form-control" name="id_produk">
                                                        @foreach($produkList as $item)
                                                            <option value="{{$item->id_produk}}">{{$item->nama_produk}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            <div class="form-group">
                                                <label for="jumlah_penjualan">Jumlah Penjualan</label>
                                                <div class="input-group margin-bottom-sm">
                                                    <input type="text" name="jumlah_penjualan"
                                                        class="form-control @error('jumlah_penjualan') is-invalid @enderror"
                                                        autofocus placeholder="Jumlah Penjualan"
                                                        value="{{ old('jumlah_penjualan', $penjualan->jumlah_penjualan) }}" />
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
