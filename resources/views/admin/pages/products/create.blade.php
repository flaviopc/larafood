@extends('adminlte::page')

@section('title', 'Novo Produto')

@section('content_header')
<h1>Novo Produto </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('products.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.pages.products.partials.form')
            </form>
        </div>
    </div>
@endsection
