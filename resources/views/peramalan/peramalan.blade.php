@extends('template')
@section('title', 'Peramalan')
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
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Alpha</th>
                                        <th scope="col">Beta</th>
                                        <th scope="col">Gamma</th>
                                        <th scope="col">Periode</th>
                                        <th scope="col">MAPE</th>
                                        <th scope="col">Akurasi</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{$item->id_perhitungan}}</td>
                                            <td>{{$item->tanggal}}</td>
                                            <td>{{$item->alpha}}</td>
                                            <td>{{$item->beta}}</td>
                                            <td>{{$item->gamma}}</td>
                                            <td>{{$item->jumlah_periode}}</td>
                                            <td>{{$item->mape}}</td>
                                            <td>{{$item->akurasi}}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="/peramalan/detail/{{ $item->id_perhitungan }}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <a href="/peramalan/delete/{{ $item->id_perhitungan }}" class="btn btn-danger btn-sm" style="margin-left: 5px;">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </a>
                                                </div>
                                            </td>
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