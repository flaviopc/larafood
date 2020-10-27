@extends('adminlte::page')

@section('title', "Planos do perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.plans',$profile->id) }}">Planos</a></li>
    </ol>
    <h1>Planos do perfil {{$profile->name}}</h1>
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
                    @foreach ($plans as $plan)
                        <tr>
                        <td>{{ $plan->name }}</td>
                        <td>{{ $plan->description ?? '' }}</td>
                        <td>
                            <a href="{{ route('plans.profile.detach',[$plan->id,$profile->id]) }}" class="btn btn-danger">Remover</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif

        </div>
    </div>
@stop
