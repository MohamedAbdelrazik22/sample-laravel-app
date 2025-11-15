<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository
{
    // Get all notes
    public function all()
    {
        return Note::all();
    }

    // Get a note by id
    public function find($id)
    {
        return Note::find($id);
    }

    // Create a new note
    public function create(array $data)
    {
        return Note::create($data);
    }

    // Update a note
    public function update(Note $note, array $data)
    {
        $note->fill($data);
        $note->save();
        return $note;
    }

    // Delete a note
    public function delete(Note $note)
    {
        return $note->delete();
    }
}
