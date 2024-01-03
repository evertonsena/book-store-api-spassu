<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_for_route_get_list_book()
    {
        Book::factory(5)->create();
        $response = $this->getJson('/api/books');
        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    public function test_for_route_show_book()
    {
        $book = Book::factory()->create();
        $response = $this->getJson("/api/books/{$book->codl}");
        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'codl' => $book->codl
                     ]
                 ]);
    }

    public function test_for_route_create_book()
    {
        $data = [
            'titulo' => 'titulo',
            'editora' => 'editora',
            'edicao' => 5,
            'anopublicacao' => '2024',
            'valor' => 100,
        ];
        $response = $this->postJson('/api/books', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment($data);
        $this->assertDatabaseHas('livro', $data);
    }

    public function test_for_route_update_author()
    {
        $book = Book::factory()->create();
        $titleUpdated = 'Título atualizado';
        $response = $this->putJson("/api/books/{$book->codl}", ['titulo' => $titleUpdated]);
        $response->assertStatus(200)
                 ->assertJsonFragment(['titulo' => $titleUpdated]);
    }

    public function test_for_route_delete_book()
    {
        $book = Book::factory()->create();
        $response = $this->deleteJson("/api/books/{$book->codl}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('livro', ['codl' => $book->codl, 'deleted_at' => NULL ]);
    }
}
