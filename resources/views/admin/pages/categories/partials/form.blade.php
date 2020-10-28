@include('admin.includes.alerts')
<div class="form-group">
    <label for="name">Nome:</label>
<input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $category->name ?? @old('name') }}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <textarea name="description" rows="8" class="form-control">{{ $category->description ?? @old('description') }}</textarea>
</div>

<div class="form-group">
   <button type="submit" class="btn btn-default">Salvar</button>
</div>
