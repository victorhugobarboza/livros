<?php

namespace Tests\Feature;

use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class LivroTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function um_livro_pode_ser_criado()
    {
        $dados = [
            'titulo' => 'Livro de Teste',
            'editora' => 'Editora de Teste',
            'edicao' => 1,
            'anoPublicacao' => '2024',
            'valor' => 59.90,
        ];

        $response = $this->post('/livros', $dados);

        $response->assertStatus(302);

        // Depurar o banco de dados para verificar os livros inseridos
        dd(Livro::all());

        $this->assertDatabaseHas('livros', [
            'titulo' => 'Livro de Teste',
        ]);
    }
    
    /** @test */
    public function um_livro_pode_ser_atualizado()
    {
        // Criar um livro inicialmente
        $livro = Livro::factory()->create([
            'titulo' => 'Livro Antigo',
            'editora' => 'Editora Antiga',
            'edicao' => 1,
            'anoPublicacao' => '2023',
            'valor' => 49.90,
        ]);

        // Dados atualizados
        $dadosAtualizados = [
            'titulo' => 'Livro Atualizado',
            'editora' => 'Editora Atualizada',
            'edicao' => 2,
            'anoPublicacao' => '2024',
            'valor' => 99.90,
        ];

        // Enviar os dados atualizados via PATCH
        $response = $this->patch("/livros/{$livro->CodL}", $dadosAtualizados);

        // Verificar se a resposta redireciona corretamente
        $response->assertStatus(302);

        // Verificar se os dados foram atualizados no banco
        $this->assertDatabaseHas('livros', [
            'titulo' => 'Livro Atualizado',
        ]);
    }

    /** @test */
    public function um_livro_pode_ser_excluido()
    {
        // Criar um livro para testar a exclusão
        $livro = Livro::factory()->create();

        // Fazer o delete na rota de exclusão de livros
        $response = $this->delete("/livros/{$livro->CodL}");

        // Verificar se foi redirecionado corretamente
        $response->assertStatus(302);

        // Verificar se o livro foi removido do banco de dados
        $this->assertDatabaseMissing('livros', [
            'CodL' => $livro->CodL,
        ]);
    }

    /** @test */
    public function verifica_se_o_banco_e_resetado_corretamente()
    {
        // Verificar se o banco está vazio no início do teste
        $this->assertEquals(0, Livro::count());

        // Criar um livro fictício
        Livro::factory()->create([
            'titulo' => 'Livro de Teste'
        ]);

        // Verificar se o livro foi adicionado corretamente
        $this->assertEquals(1, Livro::count());

        // O banco de dados será resetado automaticamente após esse teste
    }

}
