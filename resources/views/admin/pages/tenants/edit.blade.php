@extends('adminlte::page')

@section('title', 'Editar Empresa')

@section('content_header')
<h1>Editar Empresa </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('tenants.update',$tenant->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('admin.pages.tenants.partials.form')
            </form>
        </div>
    </div>
@endsection