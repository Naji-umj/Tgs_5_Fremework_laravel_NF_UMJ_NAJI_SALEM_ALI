<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // عرض جميع المؤلفين
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    // عرض مؤلف واحد بناءً على ID
    public function show($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Data author tidak ditemukan'], 404);
        }

        return response()->json($author);
    }

    // إضافة مؤلف جديد (هنا كانت المشكلة)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Data author berhasil ditambahkan',
            'data' => $author,
        ], 201);
    }

    // تحديث بيانات مؤلف
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

    // حذف مؤلف
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