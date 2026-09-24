@extends('web.categorias')

@section('conteudo')
    <div class="card">
        <h2>Pedidos</h2>

        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf

            <div>
                <label>Cliente</label>
                <select name="cliente_id" required>
                    <option value="">Selecione</option>
                    @foreach (\App\Models\Cliente::all() as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Produto</label>
                <select name="itens[0][produto_id]" required>
                    <option value="">Selecione</option>
                    @foreach (\App\Models\Produto::all() as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Quantidade</label>
                <input type="number" min="1" name="itens[0][quantidade]" value="1" required>
            </div>

            <button type="submit">Salvar</button>
        </form>

        <ul>
            @forelse ($pedidos ?? [] as $pedido)
                <li>
                    <span>{{ $pedido->id }} - {{ $pedido->cliente?->nome ?? '-' }} - {{ $pedido->status }} - R$ {{ number_format($pedido->total, 2, ',', '.') }}</span>
                    <div class="actions">
                        <a href="{{ route('pedidos.show', $pedido) }}">Ver</a>
                        <a href="{{ route('pedidos.edit', $pedido) }}">Editar</a>
                        <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </div>
                </li>
            @empty
                <li>Nenhum pedido cadastrado.</li>
            @endforelse
        </ul>
    </div>
@endsection