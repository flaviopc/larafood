@extends('adminlte::page')

@section('title', 'Novo Perfil')

@section('content_header')
<h1>Novo Perfil </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.store') }}" class="form" method="POST">
                @csrf
                @include('admin.pages.profiles.partials.form')
            </form>
        </div>
    </div>
@endsection
