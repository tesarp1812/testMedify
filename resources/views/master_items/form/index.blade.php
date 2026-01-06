@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
<<<<<<< HEAD

            <div class="form-group mb-2">
                <a href="{{ url('master-items') }}" class="btn btn-secondary">
                    Kembali ke Daftar Item
                </a>

                <!-- BUTTON MODAL -->
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalKategori">
                    + Kategori
                </button>
            </div>

            <div class="card">
                <div class="card-header">
                    {{ $method == 'new' ? 'Buat Master Item Baru' : 'Edit Master Item' }}
                </div>
=======
            <div class="form-group mb-2">
                <a href="{{url('master-items')}}" class="btn btn-secondary">Kembali ke Daftar Item</a>
            </div>
            <div class="card">

                @if($method == 'new')
                <div class="card-header">Buat Master Item Baru</div>
                @else
                <div class="card-header">Edit Master Item</div>
                @endif
>>>>>>> 59349ba4b3313a064bf732f00c507c73fff769d5

                <div class="card-body">
                    @include('master_items.form.form')
                </div>
            </div>
<<<<<<< HEAD

        </div>
    </div>
</div>

<!-- ================= MODAL KATEGORI ================= -->
<div class="modal fade" id="modalKategori" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <form method="POST" action="{{ url('categories/form/'.$method.($method == 'edit' ? '/'.$category->id : '')) }}">
             @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Kode Kategori</label>
                        <input type="text"
                               name="kode"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit"
                            class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

=======
>>>>>>> 59349ba4b3313a064bf732f00c507c73fff769d5
        </div>
    </div>
</div>
@endsection
<<<<<<< HEAD

@section('js')
@endsection
=======
@section('js')
@endsection
>>>>>>> 59349ba4b3313a064bf732f00c507c73fff769d5
