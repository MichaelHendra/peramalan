<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;
use App\Models\KotabaruModel;
use PDF;

class KotabaruController extends Controller
{
    //
    public function index()
    {
        $produkList = ProdukModel::all();
        $penjualan = KotabaruModel::join('tb_produk','tb_produk.id_produk','=','tb_kotabaru.id_produk')
        ->get(['tb_produk.nama_produk','tb_kotabaru.*']);
        return view('kotabaru.kotabaru', compact('penjualan', 'produkList'));
    }

    public function create()
    {
        $produkList = ProdukModel::all();
        $dataTerbaru = KotabaruModel::latest('id_penjualan')->first();
    
        if ($dataTerbaru != null) {
            // Mengambil angka setelah "RT" dari kode produk terakhir
            $angkaTerakhir = substr($dataTerbaru->kode_penjualan, 3);
            // Menambahkan 1 ke angka terakhir
            $angkaBaru = $angkaTerakhir + 1;
            $kodeOtomatis = 'KTB' . $angkaBaru;
        } else {
            $kodeOtomatis = 'KTB' . 1;
        } 
        return view('kotabaru.kotabaru-entry', compact('kodeOtomatis', 'produkList'));
    }

    public function store(Request $request)
{
    $this->validate($request, [
        'kode_penjualan' => 'required',
        'id_produk' => 'required',
        'jumlah_penjualan' => 'required',
    ]);

    KotabaruModel::create([
        'kode_penjualan' => $request->kode_penjualan,
        'id_produk' => $request->id_produk,
        'jumlah_penjualan' => $request->jumlah_penjualan,
    ]);
    return redirect('/kotabaru')->with('status', 'Data Penjualan berhasil ditambahkan!');
}

    public function editEmployee($id)
        {
            // Mengambil data employee dari database
            $employeeDatas = EmployeeModel::find($id);
            $departementDatas = DepartementModel::all();
            $jobDatas = JobModel::all();
            // Mengirimkan data employee ke tampilan
            return view('employee.edit-employee', compact('employeeDatas', 'departementDatas', 'jobDatas'));
        }

    public function edit($id_penjualan)
    {
        $penjualan = KotabaruModel::find($id_penjualan);
        $produkList = ProdukModel::all();
        // Mendapatkan kode otomatis dari produk yang diberikan
        $kodeOtomatis = $penjualan->kode_penjualan;

        return view('kotabaru.kotabaru-edit', compact('penjualan', 'produkList', 'kodeOtomatis'));
    }

    public function update(Request $request, $id_penjualan)
    {
        $this->validate($request, [
            'kode_penjualan' => 'required|min:2',
            'id_produk' => 'required',
            'jumlah_penjualan' => 'required'
        ]);
        $penjualan = KotabaruModel::find($id_penjualan);
        $penjualan->update([
            'kode_penjualan' => $request->kode_penjualan,
            'id_produk' => $request->id_produk,
            'jumlah_penjualan' => $request->jumlah_penjualan
        ]);
        return redirect('/kotabaru')->with('status', 'Data Penjualan  berhasil di edit!');
    }

    //delete sementara
    public function trash()
    {
        $penjualan = KotabaruModel::onlyTrashed ()->get();
        return view('kotabaru.kotabaru-trash', compact('penjualan'));
    }

    public function restore($id_penjualan = null)
    {
        if($id_penjualan != null) {
            $id_penjualan = KotabaruModel::onlyTrashed ()
            ->where('id_penjualan', $id_penjualan)
            ->restore();
        } else {
            $id_penjualan = KotabaruModel::onlyTrashed ()->restore();
        }
        return redirect('/kotabaru/trash')->with('status', 'Item Penjualan Roti berhasil di restore!');
    }

    //delete  database
    public function delete($id_penjualan)
    {
        $penjualan = KotabaruModel::find($id_penjualan);
        return view('kotabaru.kotabaru-delete', compact('penjualan'));
    }

    public function destroy($id_penjualan)
    {
        $penjualan = KotabaruModel::find($id_penjualan);

        // Pastikan record ditemukan sebelum mencoba menghapusnya
        if ($penjualan) {
            $penjualan->delete();
            return redirect('/kotabaru')->with('status', 'Item Roti berhasil dihapus!');
        } else {
            return redirect('/kotabaru')->with('status', 'Item Roti tidak ditemukan.');
        }
    }

    public function cetak()
    {
        $penjualan = KotabaruModel::all();
        // return view ('dosen.cetak-pdf',compact('dosen'));
        $pdf = PDF::loadview('kotabaru.kotabaru-cetak', ['penjualan' => $penjualan])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('kotabaru Item.pdf');
    }
   }
?>
