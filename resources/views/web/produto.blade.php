@extends('web.categorias')

@section('conteudo')
    <div class="card">
        <h2>Produtos</h2>

        <form action="{{ route('produtos.store') }}" method="POST">
            @csrf

            <div>
                <label>Categoria</label>
                <select name="categoria_id" required>
                    <option value="">Selecione</option>
                    @foreach ($categorias ?? [] as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>

            <div>
                <label>Preço</label>
                <input type="number" step="0.01" min="0" name="preco" required>
            </div>

            <div>
                <label>Estoque</label>
                <input type="number" min="0" name="estoque" value="0">
            </div>

            <button type="submit">Salvar</button>
        </form>

        <ul>
            @forelse ($produtos ?? [] as $produto)
                <li>
                    <span>{{ $produto->id }} - {{ $produto->nome }} - R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                    <div class="actions">
                        <a href="{{ route('produtos.edit', $produto) }}">Editar</a>
                        <form action="{{ route('produtos.destroy', $produto) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </div>
                </li>
            @empty
                <li>Nenhum produto cadastrado.</li>
            @endforelse
        </ul>
    </div>
@endsection