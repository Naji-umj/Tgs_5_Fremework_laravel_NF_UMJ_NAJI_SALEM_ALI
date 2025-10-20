<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    public function show($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Data author tidak ditemukan'], 404);
        }

        return response()->json($author);
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Data author tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author->update($request->all());
        return response()->json(['message' => 'Data author berhasil diperbarui', 'data' => $author]);
    }

    public function destroy($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Data author tidak ditemukan'], 404);
        }

        $author->delete();
        return response()->json(['message' => 'Data author berhasil dihapus']);
    }
}