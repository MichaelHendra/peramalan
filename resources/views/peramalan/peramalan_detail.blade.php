@extends('template')
@section('title', 'Detail Perhitungan')
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
                        <div class="row">
                            <div class="col-md-6">
                                    <strong class="card-title">Penjualan Roti</strong>
                                <div class="btn-group " role="group">
                                    <a href="/peramalan/masuk" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus"></i> Add
                                    </a>
                                    <a href="/kotabaru/cetak" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-print"></i> Print
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                {{-- <div class="input-group">
                                    <select id="filterProduk" name="id_produk" class="form-control @error('id_produk') is-invalid @enderror">
                                        <option value="">Pilih Produk</option>
                                        @foreach($produkList as $produk)
                                            <option value="{{ $produk->id_produk }}">{{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-append">
                                        <button id="filterButton" class="btn btn-primary" type="button">Filter</button>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Perhitungan</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Alpha</th>
                                        <th scope="col">Beta</th>
                                        <th scope="col">Gamma</th>
                                        <th scope="col">Season</th>
                                        <th scope="col">Akurasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{$item->id_perhitungan}}</td>
                                            <td>{{$item->dataProduk->nama_produk}}</td>
                                            <td>{{$item->tanggal_penjualan}}</td>
                                            <td>{{$item->value}}</td>
                                            <td>{{$item->trend}}</td>
                                            <td>{{$item->season}}</td>
                                            <td>{{$item->prediction}}</td>
                                        </tr>
                                    @empty
                                        <td>Kosong Boss</td>
                                    @endforelse
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#filterButton').click(function() {
                var selectedProduk = $('#filterProduk').val();
                $.ajax({
                    url: '/kotabaru/filter',
                    type: 'GET',
                    data: {
                        produk: selectedProduk
                    },
                    success: function(response) {
                        $('#penjualanTableBody').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection