@extends('adminlte::page')

@section('title', 'Editar Plano')

@section('content_header')
<h1>Editar Plano </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('plans.update',$plan->url) }}" class="form" method="POST">
                @method('PUT')
                @csrf
                @include('admin.pages.plans.partials.form')
            </form>
        </div>
    </div>
@endsection
