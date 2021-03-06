@extends('adminlte::page')

@section('title', 'Novo Plano')

@section('content_header')
<h1>Novo Plano </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('plans.store') }}" class="form" method="POST">
                @csrf
                @include('admin.pages.plans.partials.form')
            </form>
        </div>
    </div>
@endsection
