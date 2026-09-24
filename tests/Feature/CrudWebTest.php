<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrudWebTest extends TestCase
{
    use RefreshDatabase;

    public function test_categoria_edit_page_loads(): void
    {
        $categoria = Categoria::create([
            'nome' => 'Eletrônicos',
            'descricao' => 'Produtos eletrônicos',
        ]);

        $response = $this->get(route('categorias.edit', $categoria));

        $response->assertOk();
    }

    public function test_categoria_update_route_persists_changes(): void
    {
        $categoria = Categoria::create([
            'nome' => 'Roupas',
            'descricao' => 'Vestimentas',
        ]);

        $response = $this->put(route('categorias.update', $categoria), [
            'nome' => 'Acessórios',
            'descricao' => 'Itens variados',
        ]);

        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'nome' => 'Acessórios',
        ]);
    }

    public function test_cliente_edit_page_loads(): void
    {
        $cliente = Cliente::create([
            'nome' => 'Maria',
            'email' => 'maria@example.com',
            'telefone' => '11999999999',
        ]);

        $response = $this->get(route('clientes.edit', $cliente));

        $response->assertOk();
    }
}
