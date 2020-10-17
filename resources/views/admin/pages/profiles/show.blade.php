@extends('adminlte::page')

@section('title', 'Detalhes do Perfil')

@section('content_header')
<h1>Detalhes do Perfil - {{ $profile->name }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <ul>
                <li>
                    <strong>Nome: </strong>{{ $profile->name }}
                </li>

                <li>
                    <strong>Descrição: </strong>{{ $profile->description }}
                </li>
            </ul>
        <form action="{{ route('profiles.destroy',$profile->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETAR</button>
        </form>
        </div>
    </div>
@endsection
