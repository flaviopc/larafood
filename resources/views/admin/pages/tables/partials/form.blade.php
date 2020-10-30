@include('admin.includes.alerts')
<div class="form-group">
    <label for="name">Identificação:</label>
<input type="text" name="identify" class="form-control" placeholder="Identificação:" value="{{ $table->identify ?? @old('identify') }}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <textarea name="description" rows="2" class="form-control">{{ $table->description ?? @old('description') }}</textarea>
</div>

<div class="form-group">
   <button type="submit" class="btn btn-default">Salvar</button>
</div>
