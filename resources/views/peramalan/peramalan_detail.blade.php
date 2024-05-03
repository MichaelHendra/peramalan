@extends('template')
@section('title', 'Detail Perhitungan')
@section('content')
<div class="content mt-3">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                                    <strong class="card-title">Peramalan Roti</strong>
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
                                        <th scope="col">Penjualan</th>
                                        <th scope="col">Tren</th>
                                        <th scope="col">Season</th>
                                        <th scope="col">Peramalan</th>
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
                    <div class="card-body">
                        <div class="col-md-6">
                            <canvas id="salesChart" width="w-10" height="h-5"></canvas>
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
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/peramalan/chart/{{$data2->id_perhitungan}}')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.tanggal_penjualan);
                    const jumlahTerjual = data.map(item => item.value);
                    const prediksiPenjualan = data.map(item => item.prediction);

                    const ctx = document.getElementById('salesChart').getContext('2d');
                    const salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Jumlah Terjual',
                                    data: jumlahTerjual,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Prediksi Penjualan',
                                    data: prediksiPenjualan,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                });
        });
    </script>
@endsection