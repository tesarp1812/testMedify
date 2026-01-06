@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group mb-2">
                    <a href="{{ url('master-items') }}" class="btn btn-secondary">Master Items</a>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalKategori">
                        + Kategori
                    </button>
                </div>
                <div class="card">
                    <div class="card-header">Daftar Kategori</div>

                    <div class="card-body">
                        @include('master_items.index.filter')
                        @include('master_items.index.table_categories')
                    </div>

                    <!-- ================= MODAL KATEGORI ================= -->
                    <div class="modal fade" id="modalKategori" tabindex="-1">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                @php
                                    $method = 'new';
                                @endphp
                                <form method="POST"
                                    action="{{ url('categories/form/' . $method . ($method == 'edit' ? '/' . $category->id : '')) }}">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label>Kode Kategori</label>
                                            <input type="text" name="kode" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Nama Kategori</label>
                                            <input type="text" name="nama" class="form-control" required>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Batal
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Simpan
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('master_items.index.js_categories')
@endsection
