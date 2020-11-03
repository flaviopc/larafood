@extends('adminlte::page')

@section('title', 'Detalhes da Empresa')

@section('content_header')
<h1>Detalhes da Empresa - {{ $tenant->name }} </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @include('admin.includes.alerts')
        <div class="row">
            <div class="form-group">
                <img src="{{ url("storage/{$tenant->logo}")}}" alt="{{ $tenant->name }}" style="max-width:100px">
            </div>
            <div class="form-group">
                <ul>
                    <li>
                        <strong>Plano: </strong>{{ $tenant->plan->name }}
                    </li>
                    <li>
                        <strong>Nome: </strong>{{ $tenant->name }}
                    </li>
                    <li>
                        <strong>CNPJ: </strong>{{ $tenant->cnpj }}
                    </li>
                    <li>
                        <strong>URL: </strong>{{ $tenant->url }}
                    </li>
                    <li>
                        <strong>E-mail: </strong>{{ $tenant->email }}
                    </li>
                    <li>
                        <strong>Ativo: </strong>{{ $tenant->active == 'Y' ? 'SIM' : 'NÃO' }}
                    </li>
                </ul>
                <hr>
                <h3>Dados da Assinatura</h3>
                <ul>
                    <li>
                        <strong>Data Assinatura: </strong>{{ $tenant->subscription }}
                    </li>
                    <li>
                        <strong>Data Expiração: </strong>{{ $tenant->expires_at }}
                    </li>
                    <li>
                        <strong>Identificador: </strong>{{ $tenant->subscription_id }}
                    </li>
                    <li>
                        <strong>E-mail: </strong>{{ $tenant->email }}
                    </li>
                    <li>
                        <strong>Ativa: </strong>{{ $tenant->subscription_active ? 'SIM' : 'NÃO' }}
                    </li>
                    <li>
                        <strong>Cancelada: </strong>{{ $tenant->subscription_suspended ? 'SIM' : 'NÃO' }}
                    </li>
                </ul>
            </div>
        </div>
        <form action="{{ route('tenants.destroy',$tenant->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETAR</button>
        </form>
    </div>
</div>
@endsection
