@extends('web.categorias')

@section('conteudo')
    <h2>Pedido #{{ $pedido->id }}</h2>

    <p><strong>Cliente:</strong> {{ $pedido->cliente?->nome ?? '-' }}</p>
    <p><strong>Status:</strong> {{ $pedido->status }}</p>
    <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

    <h3>Adicionar item</h3>
    <form action="{{ route('pedidos.itens.store', $pedido) }}" method="POST">
        @csrf

        <label>Produto</label>
        <select name="produto_id" required>
            <option value="">Selecione</option>
            @foreach (\App\Models\Produto::all() as $produto)
                <option value="{{ $produto->id }}">{{ $produto->nome }} - R$ {{ number_format($produto->preco, 2, ',', '.') }}</option>
            @endforeach
        </select>

        <label>Quantidade</label>
        <input type="number" min="1" name="quantidade" value="1" required>

        <button type="submit">Adicionar</button>
    </form>

    <h3>Itens do pedido</h3>
    <ul>
        @forelse ($pedido->itens as $item)
            <li>
                {{ $item->produto?->nome ?? '-' }} - Quantidade: {{ $item->quantidade }} - Preço: R$ {{ number_format($item->preco, 2, ',', '.') }}
            </li>
        @empty
            <li>Nenhum item neste pedido.</li>
        @endforelse
    </ul>

    <a href="{{ route('pedidos.index') }}">Voltar</a>
@endsection
