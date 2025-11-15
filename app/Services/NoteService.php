<?php

namespace App\Services;

use App\Repositories\NoteRepository;

class NoteService
{
    protected $repository;

    // Inject repository into the service
    public function __construct(NoteRepository $repository)
    {
        $this->repository = $repository;
    }

    // Get all notes
    public function getAllNotes()
    {
        return $this->repository->all();
    }

    // Get a single note
    public function getNoteById($id)
    {
        return $this->repository->find($id);
    }

    // Create a note
    public function createNote(array $data)
    {
        return $this->repository->create($data);
    }

    // Update a note
    public function updateNote($id, array $data)
    {
        $note = $this->repository->find($id);
        if (! $note) {
            return null;
        }

        return $this->repository->update($note, $data);
    }

    // Delete a note
    public function deleteNote($id)
    {
        $note = $this->repository->find($id);
        if (! $note) {
            return false;
        }

        return $this->repository->delete($note);
    }
}
