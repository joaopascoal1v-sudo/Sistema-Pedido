@extends('web.categorias')

@section('conteudo')
    <div class="card">
        <h2>Categorias</h2>

        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf

            <div>
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>

            <div>
                <label>Descrição</label>
                <textarea name="descricao"></textarea>
            </div>

            <button type="submit">Salvar</button>
        </form>

        <ul>
            @forelse ($categorias ?? [] as $categoria)
                <li>
                    <span>{{ $categoria->id }} - {{ $categoria->nome }} - {{ $categoria->descricao ?? '-' }}</span>
                    <div class="actions">
                        <a href="{{ route('categorias.edit', $categoria) }}">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </div>
                </li>
            @empty
                <li>Nenhuma categoria cadastrada.</li>
            @endforelse
        </ul>
    </div>
@endsection
