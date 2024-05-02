<?php

namespace App\Http\Controllers;

use App\Models\Hitung;
use App\Models\HitungDetail;
use App\Models\KotabaruModel;
use App\Models\ProdukModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class prediksiController extends Controller
{
    public function index(){
       $data = Hitung::all();
        return view('peramalan/peramalan' , ['data' => $data]);
    }
    public function create()  {
        $dataTerbaru = Hitung::latest('id_perhitungan')->first();
        if ($dataTerbaru != null) {
            // Mengambil angka setelah "RT" dari kode produk terakhir
            $angkaTerakhir = substr($dataTerbaru->id_perhitungan, 3);
            // Menambahkan 1 ke angka terakhir
            $angkaBaru = $angkaTerakhir + 1;
            $kodeOtomatis = 'PRE' . $angkaBaru;
        } else {
            $kodeOtomatis = 'PRE' . 1;
        } 
        $produkList = ProdukModel::all();
        $now = Carbon::today()->toDateString();
        return view('peramalan/peramalan_create', ['produkList' => $produkList, 'id' => $kodeOtomatis, 'now' => $now]);
    }
    public function store(Request $request){

        $id = $request->id_perhitungan;
        $data = KotabaruModel::where('id_produk', $request->id_produk)->orderBy('tanggal_penjualan')->pluck('jumlah_penjualan')->toArray();
        $produk = $request->id_produk;
        $tanggal = $request->tanggal;
        $alpha = $request->alpha;
        $beta = $request->beta;
        $gamma = $request->gamma;
        $periode = $request->season;
        // dd($data);
        $tanggalPenjualan = KotabaruModel::where('id_produk', $produk)->pluck('tanggal_penjualan')->toArray();


        
        
        // Hitung::create([
        //     'id_perhitungan' => $id,
        //     'tanggal' => $tanggal,
        //     'alpha' => $alpha,
        //     'beta' => $beta,
        //     'gamma' => $gamma,
        //     'jumlah_periode' => $periode,
        //     'mape' => 0,
        //     'akurasi' => 0
        // ]);
        
        $this->holtWinters($data,$alpha,$beta,$gamma,$id,$produk,$periode,$tanggalPenjualan);
    //    dd($pre);

         return redirect('/peramalan/detail/'.$id);
        
    }
    private function holtWinters($data, $alpha, $beta, $gamma,$id,$produk,$periode,$tanggalPenjualan)
    {
        // Inisialisasi variabel untuk level, tren, dan musim
        $level = $data[0];
        $trend = 0;
        $season = [];
        $seasonLength = 12;
        // dd($level);
    
        // Hitung musim awal
        for ($i = 0; $i < $seasonLength; $i++) {
            $season[] = $data[$i];
        }
    
        $predictions = [];
    
        // Loop melalui setiap titik data
        foreach ($data as $index => $value) {
            // Hitung peramalan untuk titik waktu saat ini$
            $lastLevel = $level;
            $lastTrend = $trend;
            $lastSeason = $season[$index % $seasonLength];
    
            $level = $alpha * ($value - $lastSeason) + (1 - $alpha) * ($lastLevel + $lastTrend);
            $trend = $beta * ($level - $lastLevel) + (1 - $beta) * $lastTrend;
            $season[$index % $seasonLength] = $gamma * ($value - $lastLevel) + (1 - $gamma) * $lastSeason;
            // Hitung peramalan
            $prediction = $level + $trend + $season[$index % $seasonLength];
            HitungDetail::create([
                'id_perhitungan' => $id,
                'id_produk' => $produk,
                'tanggal_penjualan'=> $tanggalPenjualan[$index],
                'value' => $value,
                'level' => $level,
                'trend' => $trend,
                'season' => $season[$index % $seasonLength],
                'prediction' => $prediction
            ]);
            $predictions[] = $prediction;
        }
        $startIndex = count($data) - 1;

for ($i = 0; $i < $periode; $i++) {
    $level += $trend;
    $seasonIndex = ($startIndex + $i + 1) % $seasonLength;
    $prediction = $level + $trend + $season[$seasonIndex];
    
    // Calculate the next date based on the current iteration index and the number of weeks
    $nextDate = date('Y-m-d', strtotime($tanggalPenjualan[$startIndex]) + (($i + 1) * 7 * 86400)); // Assuming each period is one week
    
    // Output the next date for debugging
    // dd($nextDate);
    
    // Create HitungDetail record for the prediction
    HitungDetail::create([
        'id_perhitungan' => $id,
        'id_produk' => $produk,
        'tanggal_penjualan' => $nextDate,
        'prediction' => $prediction
    ]);
    
    $predictions[] = $prediction;
}
    
        return $predictions;
    }

    public function detail($id) {
        $data = HitungDetail::where('id_perhitungan',$id)->get();
        return view('peramalan/peramalan_detail',['data' => $data]);
    }
}
