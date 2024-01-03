<?php

namespace Tests\Feature;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_for_route_get_list_subjects()
    {
        Subject::factory(5)->create();
        $response = $this->getJson('/api/subjects');
        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    public function test_for_route_show_subject()
    {
        $subject = Subject::factory()->create();
        $response = $this->getJson("/api/subjects/{$subject->codas}");
        $response->assertStatus(200)
                 ->assertJson(['data' => ['codas' => $subject->codas]]);
    }

    public function test_for_route_create_subject()
    {
        $data = [
            'descricao' => 'Descricao do Assunto',
        ];
        $response = $this->postJson('/api/subjects', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['descricao' => $data['descricao']]);
        $this->assertDatabaseHas('assunto', $data);
    }

    public function test_for_route_update_subject()
    {
        $subject = Subject::factory()->create();
        $descriptionUpdate = 'Assunto Atualizado';
        $response = $this->putJson("/api/subjects/{$subject->codas}", ['descricao' => $descriptionUpdate]);
        $response->assertStatus(200)
                 ->assertJsonFragment(['descricao' => $descriptionUpdate]);
    }

    public function test_for_route_delete_subject()
    {
        $subject = Subject::factory()->create();
        $response = $this->deleteJson("/api/subjects/{$subject->codas}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('assunto', ['codas' => $subject->codas, 'deleted_at' => NULL ]);
    }
}
