@extends('adminlte::page')

@section('title', 'Editar Mesa')

@section('content_header')
<h1>Editar Mesa </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('tables.update',$table->id) }}" class="form" method="POST">
                @method('PUT')
                @csrf
                @include('admin.pages.tables.partials.form')
            </form>
        </div>
    </div>
@endsection
