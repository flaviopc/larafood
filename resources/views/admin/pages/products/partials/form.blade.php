@include('admin.includes.alerts')
<div class="form-group">
    <label for="title">Titulo:</label>
<input type="text" name="title" class="form-control" placeholder="Titulo:" value="{{ $product->title ?? @old('title') }}">
</div>
<div class="form-group">
    <label for="price">Preço:</label>
<input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $product->price ?? @old('price') }}">
</div>
<div class="form-group">
    <label for="title">Imagem:</label>
<input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <textarea name="description" rows="8" class="form-control">{{ $product->description ?? @old('description') }}</textarea>
</div>

<div class="form-group">
   <button type="submit" class="btn btn-default">Salvar</button>
</div>
