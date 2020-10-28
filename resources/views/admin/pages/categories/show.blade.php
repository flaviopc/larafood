@extends('adminlte::page')

@section('title', 'Detalhes da Categoria')

@section('content_header')
<h1>Detalhes da Categoria - {{ $category->name }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Nome: </strong>{{ $category->name }}
                </li>
                <li>
                    <strong>URL: </strong>{{ $category->url }}
                </li>
                <li>
                    <strong>Descrição: </strong>{{ $category->description }}
                </li>
            </ul>
        <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETAR</button>
        </form>
        </div>
    </div>
@endsection
