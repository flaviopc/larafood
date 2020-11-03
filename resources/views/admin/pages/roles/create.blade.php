@extends('adminlte::page')

@section('title', 'Novo Cargo')

@section('content_header')
<h1>Novo Cargo </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" class="form" method="POST">
                @csrf
                @include('admin.pages.roles.partials.form')
            </form>
        </div>
    </div>
@endsection
