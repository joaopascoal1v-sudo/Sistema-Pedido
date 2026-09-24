@extends('web.categorias')

@section('conteudo')
    <h2>Editar produto</h2>

    <form action="{{ route('produtos.update', $produto) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Categoria</label>
        <select name="categoria_id" required>
            <option value="">Selecione</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('categoria_id', $produto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>

        <label>Nome</label>
        <input type="text" name="nome" value="{{ old('nome', $produto->nome) }}" required>

        <label>Preço</label>
        <input type="number" step="0.01" min="0" name="preco" value="{{ old('preco', $produto->preco) }}" required>

        <label>Estoque</label>
        <input type="number" min="0" name="estoque" value="{{ old('estoque', $produto->estoque) }}">

        <button type="submit">Atualizar</button>
        <a href="{{ route('produtos.index') }}">Cancelar</a>
    </form>
@endsection
