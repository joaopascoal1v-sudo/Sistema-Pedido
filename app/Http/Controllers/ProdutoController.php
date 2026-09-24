<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->get();
        $categorias = Categoria::all();

        return view('web.produto', compact('produtos', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'nullable|integer|min:0',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();

        return view('web.produto_edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'nullable|integer|min:0',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
