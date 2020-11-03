@include('admin.includes.alerts')
<div class="form-group">
    <label for="title">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $tenant->name ?? @old('name') }}">
</div>
@if (request()->route()->getAction()['as'] === 'tenants.edit')
<div class="form-group">
    <label for="logo">Logo:</label>
    <input type="file" name="logo" class="form-control">
</div>
@endif
<div class="form-group">
    <label for="email">Email:</label>
    <input type="text" name="email" class="form-control" placeholder="Email:"
        value="{{ $tenant->email ?? @old('email') }}">
</div>
<div class="form-group">
    <label for="cnpj">CNPJ:</label>
    <input type="text" name="cnpj" class="form-control" placeholder="cnpj:" value="{{ $tenant->cnpj ?? @old('cnpj') }}">
</div>
<div class="form-group">
    <label>Ativo?</label>
    <select name="active">
        <option value="Y" @if(isset($tenant) && $tenant->active == 'Y') selected @endif>SIM</option>
        <option value="N" @if(isset($tenant) && $tenant->active == 'N') selected @endif>SIM</option>
    </select>
</div>
<h3>Dados da Assinatura</h3>
<div class="form-group">
    <label>Data Assinatura:</label>
    <input type="date" name="subscription" class="form-control" placeholder="Data Assinatura:"
        value="{{ $tenant->subscription ?? @old('subscription') }}">
</div>
<div class="form-group">
    <label>Validade:</label>
    <input type="date" name="expires_at" class="form-control" placeholder="Validade:"
        value="{{ $tenant->expires_at ?? @old('expires_at') }}">
</div>
<div class="form-group">
    <label>Identificador:</label>
    <input type="text" name="subscription_id" class="form-control" placeholder="Identificador:"
        value="{{ $tenant->subscription_id ?? @old('subscription_id') }}">
</div>
<div class="form-group">
    <label>Assinatura Ativa?</label>
    <select name="subscription_active">
        <option value="1" @if(isset($tenant) && $tenant->subscription_active) selected @endif>SIM</option>
        <option value="0" @if(isset($tenant) && $tenant->subscription_active) selected @endif>SIM</option>
    </select>
</div>
<div class="form-group">
    <label>Assinatura Cancelada?</label>
    <select name="subscription_suspended">
        <option value="1" @if(isset($tenant) && $tenant->subscription_suspended) selected @endif>SIM</option>
        <option value="0" @if(isset($tenant) && $tenant->subscription_suspended) selected @endif>SIM</option>
    </select>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-default">Salvar</button>
</div>
