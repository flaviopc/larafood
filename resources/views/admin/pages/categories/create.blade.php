@extends('adminlte::page')

@section('title', 'Nova Categoria')

@section('content_header')
<h1>Nova Categoria </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('categories.store') }}" class="form" method="POST">
                @csrf
                @include('admin.pages.categories.partials.form')
            </form>
        </div>
    </div>
@endsection
