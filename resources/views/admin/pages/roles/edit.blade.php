@extends('adminlte::page')

@section('title', 'Editar Cargo')

@section('content_header')
<h1>Editar Cargo </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('roles.update',$role->id) }}" class="form" method="POST">
                @method('PUT')
                @csrf
                @include('admin.pages.roles.partials.form')
            </form>
        </div>
    </div>
@endsection
