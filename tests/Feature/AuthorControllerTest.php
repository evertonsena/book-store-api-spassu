<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_for_route_get_list_author()
    {
        Author::factory(5)->create();
        $response = $this->getJson('/api/authors');
        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    public function test_for_route_show_author()
    {
        $author = Author::factory()->create();
        $response = $this->getJson("/api/authors/{$author->codau}");
        $response->assertStatus(200)
                 ->assertJson(['data' => ['codau' => $author->codau]]);
    }

    public function test_for_route_create_author()
    {
        $data = [
            'nome' => 'Nome do Autor',
        ];
        $response = $this->postJson('/api/authors', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['nome' => $data['nome']]);
        $this->assertDatabaseHas('autor', $data);
    }

    public function test_for_route_update_author()
    {
        $author = Author::factory()->create();
        $nameUpdated = 'Nome Atualizado';
        $response = $this->putJson("/api/authors/{$author->codau}", ['nome' => $nameUpdated]);
        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => $nameUpdated]);
    }

    public function test_for_route_delete_author()
    {
        $author = Author::factory()->create();
        $response = $this->deleteJson("/api/authors/{$author->codau}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('autor', ['codau' => $author->codau, 'deleted_at' => NULL ]);
    }
}
