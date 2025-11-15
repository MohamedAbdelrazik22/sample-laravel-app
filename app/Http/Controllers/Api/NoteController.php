<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Services\NoteService;

class NoteController extends Controller
{
    protected $noteService;

    // Inject the service layer into the controller
    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    // Return all notes
    public function index()
    {
        $notes = $this->noteService->getAllNotes();
        return response()->json(['data' => $notes], 200);
    }

    // Create a new note
    public function store(StoreNoteRequest $request)
    {
        // Validation is handled by FormRequest
        $data = $request->validated();

        $note = $this->noteService->createNote($data);

        return response()->json(['data' => $note], 201);
    }

    // Show single note
    public function show($id)
    {
        $note = $this->noteService->getNoteById($id);

        if (! $note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        return response()->json(['data' => $note], 200);
    }

    // Update note
    public function update(UpdateNoteRequest $request, $id)
    {
        // Validation is handled by FormRequest
        $data = $request->validated();

        $note = $this->noteService->updateNote($id, $data);

        if (! $note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        return response()->json(['data' => $note], 200);
    }

    // Delete note
    public function destroy($id)
    {
        $deleted = $this->noteService->deleteNote($id);

        if (! $deleted) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        return response()->json(null, 204);
    }
}
