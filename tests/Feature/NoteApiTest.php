<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_notes()
    {
        Note::factory()->create(['title' => 'A', 'content' => 'a']);
        Note::factory()->create(['title' => 'B', 'content' => 'b']);

        $resp = $this->getJson('/api/notes');

        $resp->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    public function test_store_creates_note()
    {
        $resp = $this->postJson('/api/notes', [
            'title' => 'New note',
            'content' => 'Hello'
        ]);

        $resp->assertStatus(201)
            ->assertJsonPath('data.title', 'New note');

        $this->assertDatabaseHas('notes', ['title' => 'New note']);
    }

    public function test_show_returns_single_note()
    {
        $note = Note::factory()->create(['title' => 'One']);

        $resp = $this->getJson('/api/notes/'.$note->id);

        $resp->assertStatus(200)
            ->assertJsonPath('data.id', $note->id);
    }

    public function test_update_modifies_note()
    {
        $note = Note::factory()->create(['title' => 'Old']);

        $resp = $this->putJson('/api/notes/'.$note->id, [
            'title' => 'Updated'
        ]);

        $resp->assertStatus(200)
            ->assertJsonPath('data.title', 'Updated');

        $this->assertDatabaseHas('notes', ['id' => $note->id, 'title' => 'Updated']);
    }

    public function test_destroy_deletes_note()
    {
        $note = Note::factory()->create();

        $resp = $this->deleteJson('/api/notes/'.$note->id);

        $resp->assertStatus(204);

        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }
}
