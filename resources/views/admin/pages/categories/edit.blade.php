@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
<h1>Editar Categoria </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('categories.update',$category->id) }}" class="form" method="POST">
                @method('PUT')
                @csrf
                @include('admin.pages.categories.partials.form')
            </form>
        </div>
    </div>
@endsection
