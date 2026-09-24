<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['cliente', 'itens.produto'])->get();

        return view('web.pedido', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();

        return view('web.pedido', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $pedido = Pedido::create([
                'cliente_id' => $request->cliente_id,
                'status' => 'pendente',
                'total' => 0,
            ]);

            $total = 0;

            foreach ($request->itens as $item) {
                $produto = Produto::findOrFail($item['produto_id']);

                $pedido->itens()->create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $item['quantidade'],
                    'preco' => $produto->preco,
                ]);

                $total += $produto->preco * $item['quantidade'];
            }

            $pedido->update([
                'total' => $total,
            ]);

            DB::commit();

            return redirect()->route('pedidos.index')->with('success', 'Pedido cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Erro ao salvar o pedido: ' . $e->getMessage());
        }
    }

    public function show(Pedido $pedido)
    {
        $pedido->load(['cliente', 'itens.produto']);

        return view('web.pedido_show', compact('pedido'));
    }

    public function adicionarItens(Request $request, Pedido $pedido)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        $pedido->itens()->create([
            'produto_id' => $produto->id,
            'quantidade' => $request->quantidade,
            'preco' => $produto->preco,
        ]);

        $pedido->total = $pedido->itens()->sum(DB::raw('quantidade * preco'));
        $pedido->save();

        return back()->with('success', 'Produto adicionado ao pedido com sucesso!');
    }

    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();

        return view('web.pedido_edit', compact('pedido', 'clientes', 'produtos'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'status' => 'required|in:pendente,aprovado,finalizado,cancelado',
            'total' => 'nullable|numeric|min:0',
        ]);

        $pedido->update([
            'cliente_id' => $request->cliente_id,
            'status' => $request->status,
            'total' => $request->total ?? $pedido->total,
        ]);

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->itens()->delete();
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso!');
    }
}