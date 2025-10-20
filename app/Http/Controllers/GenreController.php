<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

    public function show($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['message' => 'Data genre tidak ditemukan'], 404);
        }

        return response()->json($genre);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['message' => 'Data genre tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->update($request->all());
        return response()->json(['message' => 'Data genre berhasil diperbarui', 'data' => $genre]);
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['message' => 'Data genre tidak ditemukan'], 404);
        }

        $genre->delete();
        return response()->json(['message' => 'Data genre berhasil dihapus']);
    }
}