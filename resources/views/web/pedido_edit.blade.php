@extends('web.categorias')

@section('conteudo')
    <h2>Editar pedido</h2>

    <form action="{{ route('pedidos.update', $pedido) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Cliente</label>
        <select name="cliente_id" required>
            <option value="">Selecione</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('cliente_id', $pedido->cliente_id) == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>

        <label>Status</label>
        <select name="status" required>
            @foreach (['pendente', 'aprovado', 'finalizado', 'cancelado'] as $status)
                <option value="{{ $status }}" {{ old('status', $pedido->status) == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        <label>Total</label>
        <input type="number" step="0.01" min="0" name="total" value="{{ old('total', $pedido->total) }}">

        <button type="submit">Atualizar</button>
        <a href="{{ route('pedidos.index') }}">Cancelar</a>
    </form>
@endsection
