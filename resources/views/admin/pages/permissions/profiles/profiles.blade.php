@extends('adminlte::page')

@section('title', "Perfis com a permissão {$permission->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>
    <h1>Perfis com a permissão {{$permission->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-border">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th style="width: 150px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                        <tr>
                        <td>{{ $profile->name }}</td>
                        <td>{{ $profile->description ?? '' }}</td>
                        <td>
                            <a href="{{ route('profiles.permissions.detach',[$profile->id,$permission->id]) }}" class="btn btn-danger">Remover</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif

        </div>
    </div>
@stop
