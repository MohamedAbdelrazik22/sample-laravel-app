<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // Return all notes
    public function index()
    {
        $notes = Note::all();
        return response()->json(['data' => $notes], 200);
    }

    // Create a new note
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $note = Note::create($data);

        return response()->json(['data' => $note], 201);
    }

    // Show single note
    public function show($id)
    {
        $note = Note::find($id);

        if (! $note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        return response()->json(['data' => $note], 200);
    }

    // Update note
    public function update(Request $request, $id)
    {
        $note = Note::find($id);

        if (! $note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $note->fill($data);
        $note->save();

        return response()->json(['data' => $note], 200);
    }

    // Delete note
    public function destroy($id)
    {
        $note = Note::find($id);

        if (! $note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $note->delete();
        return response()->json(null, 204);
    }
}
