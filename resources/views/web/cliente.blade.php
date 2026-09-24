@extends('web.categorias')

@section('conteudo')
    <div class="card">
        <h2>Clientes</h2>

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div>
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label>Telefone</label>
                <input type="text" name="telefone">
            </div>

            <button type="submit">Salvar</button>
        </form>

        <ul>
            @forelse ($clientes ?? [] as $cliente)
                <li>
                    <span>{{ $cliente->id }} - {{ $cliente->nome }} - {{ $cliente->email }}</span>
                    <div class="actions">
                        <a href="{{ route('clientes.edit', $cliente) }}">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </div>
                </li>
            @empty
                <li>Nenhum cliente cadastrado.</li>
            @endforelse
        </ul>
    </div>
@endsection