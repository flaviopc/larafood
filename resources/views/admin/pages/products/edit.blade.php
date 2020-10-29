@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')
<h1>Editar Produto </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('products.update',$product->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('admin.pages.products.partials.form')
            </form>
        </div>
    </div>
@endsection
