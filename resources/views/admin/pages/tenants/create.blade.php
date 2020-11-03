@extends('adminlte::page')

@section('title', 'Novo Empresa')

@section('content_header')
<h1>Novo Empresa </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('tenants.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.pages.tenants.partials.form')
            </form>
        </div>
    </div>
@endsection
