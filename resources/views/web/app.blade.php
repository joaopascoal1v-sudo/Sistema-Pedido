<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validação: Garante que os dados obrigatórios foram enviados
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'itens' => 'required|array|min:1', // Tem que ser um array com pelo menos 1 item
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1',
        ]);

        // 2. Transaction: Se o sistema travar no meio, ele cancela e não salva o pedido pela metade
        try {
            DB::beginTransaction();

            // 3. Cria o pedido inicial zerado
            $pedido = Pedido::create([
                'cliente_id' => $request->cliente_id,
                'status' => 'pendente',
                'valor_total' => 0,
            ]);

            $valorTotal = 0;

            // 4. Percorre os itens enviados
            foreach ($request->itens as $item) {
                // Busca o produto no banco (NUNCA confie no preço enviado pelo frontend)
                $produto = Produto::findOrFail($item['produto_id']);
                
                // Salva o item relacionado ao pedido
                $pedido->itens()->create([
                    'produto_id' => $produto->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $produto->preco, // Salva o preço atual do produto
                ]);

                // Vai somando o valor total
                $valorTotal += ($produto->preco * $item['quantidade']);
            }

            // 5. Atualiza o pedido com o valor total calculado
            $pedido->update([
                'valor_total' => $valorTotal
            ]);

            // Confirma o salvamento de tudo no banco
            DB::commit();

            // Retorna o pedido completo com os itens e dados do produto
            return response()->json([
                'mensagem' => 'Pedido criado com sucesso!',
                'pedido' => $pedido->load('itens.produto') 
            ], 201);

        } catch (\Exception $e) {
            // Se deu qualquer erro (banco de dados, falha de rede), desfaz tudo
            DB::rollBack(); 
            
            return response()->json([
                'erro' => 'Erro ao salvar o pedido: ' . $e->getMessage()
            ], 500);
        }
    }
}