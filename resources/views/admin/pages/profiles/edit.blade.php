@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content_header')
<h1>Editar Perfil </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('profiles.update',$profile->id) }}" class="form" method="POST">
                @method('PUT')
                @csrf
                @include('admin.pages.profiles.partials.form')
            </form>
        </div>
    </div>
@endsection
