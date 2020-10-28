@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
<h1>Novo Usuário </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('users.store') }}" class="form" method="POST">
                @csrf
                @include('admin.pages.users.partials.form')
            </form>
        </div>
    </div>
@endsection
