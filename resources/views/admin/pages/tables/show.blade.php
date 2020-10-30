@extends('adminlte::page')

@section('title', 'Detalhes da Mesa')

@section('content_header')
<h1>Detalhes da Mesa: {{ $table->identify }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Idenficação: </strong>{{ $table->identify }}
                </li>
                <li>
                    <strong>Descrição: </strong>{{ $table->description }}
                </li>
            </ul>
        <form action="{{ route('tables.destroy',$table->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETAR</button>
        </form>
        </div>
    </div>
@endsection
