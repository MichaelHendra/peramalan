<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;
use PDF;

class ProdukController extends Controller
{
    //
    public function index()
    {
        $produk = ProdukModel::all();
        return view('produk.produk', compact('produk'));
    }

    public function create()
    {
        $dataTerbaru = ProdukModel::latest('id_produk')->first();
    
        if ($dataTerbaru != null) {
            // Mengambil angka setelah "RT" dari kode produk terakhir
            $angkaTerakhir = substr($dataTerbaru->kode_produk, 2);
            // Menambahkan 1 ke angka terakhir
            $angkaBaru = $angkaTerakhir + 1;
            $kodeOtomatis = 'RT' . $angkaBaru;
        } else {
            $kodeOtomatis = 'RT' . 1;
        }
    
        return view('produk.produk-entry')->with('kodeOtomatis', $kodeOtomatis);
    }
    





    // public function create()
    // {
    //     $dataTerbaru = ProdukModel::latest('id_produk')->first(); // Mengambil produk terbaru berdasarkan id_produk

    //     if ($dataTerbaru != null) {
    //         $kodeOtomatis = 'RT' . ($dataTerbaru->id_produk + 1);
    //     } else {
    //         $kodeOtomatis = 'RT' .  1;
    //     }
        
    //     return view('produk.produk-entry')->with('kodeOtomatis', $kodeOtomatis);
    // }


    // public function create()
    // {
    //     $dataTerbaru = ProdukModel::all()->last();

    //     if ($dataTerbaru != null) {
    //         $kodeOtomatis = 'RT' . $dataTerbaru->count() + 1;
    //     } else {
    //         $kodeOtomatis = 'RT' .  1;
    //     }
    //     return view('produk.produk-entry')->with('kodeOtomatis', $kodeOtomatis);
    // }

    //insert data ke database
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_produk' => 'required|min:2',
            'nama_produk' => 'required',
            'harga_jual' => 'required',
        ]);

        ProdukModel::create([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'harga_jual' => $request->harga_jual,
        ]);
        return redirect('/produk')->with('status', 'Produk Roti berhasil ditambahkan!');
    }

    public function edit($id_produk)
{
    $produksi = ProdukModel::find($id_produk);

    // Mendapatkan kode otomatis dari produk yang diberikan
    $kodeOtomatis = $produksi->kode_produk;

    return view('produk.produk-edit', compact('produksi', 'kodeOtomatis'));
}


    public function update(Request $request, $id_produk)
    {
        $this->validate($request, [
            'kode_produk' => 'required|min:2',
            'nama_produk' => 'required',
            'harga_jual' => 'required'
        ]);
        $produksi = ProdukModel::find($id_produk);
        $produksi->update([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'harga_jual' => $request->harga_jual
        ]);
        return redirect('/produk')->with('status', 'Data Roti  berhasil di edit!');
    }

    //delete sementara
    public function trash()
    {
        $produksi = ProdukModel::onlyTrashed ()->get();
        return view('produk.produk-trash', compact('produksi'));
    }

    public function restore($id_produk = null)
    {
        if($id_produk != null) {
            $id_produk = ProdukModel::onlyTrashed ()
            ->where('id_produk', $id_produk)
            ->restore();
        } else {
            $id_produk = ProdukModel::onlyTrashed ()->restore();
        }
        return redirect('/produk/trash')->with('status', 'Item Roti berhasil di restore!');
    }

    //delete  database
    public function delete($id_produk)
    {
        $produksi = ProdukModel::find($id_produk);
        return view('produk.produk-delete', compact('produksi'));
    }

    public function destroy($id_produk)
    {
        $produksi = ProdukModel::find($id_produk);

        // Pastikan record ditemukan sebelum mencoba menghapusnya
        if ($produksi) {
            $produksi->delete();
            return redirect('/produk')->with('status', 'Item Roti berhasil dihapus!');
        } else {
            return redirect('/produk')->with('status', 'Item Roti tidak ditemukan.');
        }
    }

    public function cetak()
    {
        $produksi = ProdukModel::all();
        // return view ('dosen.cetak-pdf',compact('dosen'));
        $pdf = PDF::loadview('produk.produk-cetak', ['produksi' => $produksi])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('Produk Item.pdf');
    }
   }
?>
