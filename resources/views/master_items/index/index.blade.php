@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group mb-2">
                    <a href="{{ url('master-items/form/new') }}" class="btn btn-secondary">+ Master Items Baru</a>
                    <a href="{{ url('categories') }}" class="btn btn-secondary"> Kategori</a>
                    <a href="{{ route('master-items.export') }}" class="btn btn-success"> Download Excel </a>


                </div>
                <div class="card">
                    <div class="card-header">Daftar Master Items</div>

                    <div class="card-body">
                        @include('master_items.index.filter')
                        @include('master_items.index.table')
                    </div>
=======
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{url('master-items/form/new')}}" class="btn btn-secondary">+ Master Items Baru</a>
            </div>
            <div class="card">
                <div class="card-header">Daftar Master Items</div>

                <div class="card-body">
                    @include('master_items.index.filter')
                    @include('master_items.index.table')
>>>>>>> 59349ba4b3313a064bf732f00c507c73fff769d5
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
@endsection
@section('js')
    @include('master_items.index.js')
@endsection
=======
</div>
@endsection
@section('js')
@include('master_items.index.js')
@endsection
>>>>>>> 59349ba4b3313a064bf732f00c507c73fff769d5
