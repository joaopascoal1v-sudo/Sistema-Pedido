@extends('web.categorias')

@section('conteudo')
    <h2>Editar cliente</h2>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nome</label>
        <input type="text" name="nome" value="{{ old('nome', $cliente->nome) }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $cliente->email) }}" required>

        <label>Telefone</label>
        <input type="text" name="telefone" value="{{ old('telefone', $cliente->telefone) }}">

        <button type="submit">Atualizar</button>
        <a href="{{ route('clientes.index') }}">Cancelar</a>
    </form>
@endsection
