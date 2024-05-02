@extends('template')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Grafik Peramalan Penjualan Roti
                </div>
                <div class="card-body">
                    <!-- Tambahkan grafik peramalan di sini -->
                    <!-- Contoh: <canvas id="grafikPeramalan" width="400" height="200"></canvas> -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Tabel Peramalan Penjualan Roti
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Bulan</th>
                                <th scope="col">Peramalan Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Isi tabel dengan data peramalan penjualan -->
                            <!-- Contoh: <tr><td>Juli 2024</td><td>1500</td></tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
