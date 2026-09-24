@extends('web.categorias')

@section('conteudo')
    <h2>Editar categoria</h2>

    <form action="{{ route('categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nome</label>
        <input type="text" name="nome" value="{{ old('nome', $categoria->nome) }}" required>

        <label>Descrição</label>
        <textarea name="descricao">{{ old('descricao', $categoria->descricao) }}</textarea>

        <button type="submit">Atualizar</button>
        <a href="{{ route('categorias.index') }}">Cancelar</a>
    </form>
@endsection
