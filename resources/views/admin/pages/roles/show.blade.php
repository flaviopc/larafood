@extends('adminlte::page')

@section('title', 'Detalhes do Cargo')

@section('content_header')
<h1>Detalhes do Cargo - {{ $role->name }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Nome: </strong>{{ $role->name }}
                </li>

                <li>
                    <strong>Descrição: </strong>{{ $role->description }}
                </li>
            </ul>
        <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETAR</button>
        </form>
        </div>
    </div>
@endsection
