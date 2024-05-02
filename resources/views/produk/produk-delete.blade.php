@extends('template')
@section('title', 'Produk Delete')
@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left">
                            <strong class="card-title">Produk</strong>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="card-body">
                            <div class="form-login text-center"> <!-- Mengatur teks pertanyaan ke tengah -->
                                <h4>Ingin Menghapus Item Roti?</h4>
                                <div class="confirmation-buttons text-center">
                                    <form action="{{ url('/produk/destroy/' . $produksi->id_produk) }}"
                                        method="get" style="display: inline;">
                                        @csrf                                    
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" name="hapus">
                                            Yes
                                        </button>
                                    </form>
                                    <a href="/produk" class="btn btn-secondary">No</a>
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
