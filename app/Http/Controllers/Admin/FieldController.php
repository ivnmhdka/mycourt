<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = Field::paginate(10);
        return view('admin.fields.index', compact('fields'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fields.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string',
        'price_per_hour' => 'required|numeric',
        'description' => 'nullable|string',
        'image_path' => 'nullable|url',
    ]);

    Field::create($request->all());

        return redirect()
            ->route('admin.fields.index')
            ->with('success', 'Lapangan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $field)
    {
        return view('admin.fields.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Field $field)
    {
        // Validasi input (PAKAI IMAGE PATH, BUKAN FILE)
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Futsal,Badminton,Basketball',
            'price_per_hour' => 'required|numeric',
            'description' => 'nullable|string',
            'image_path' => 'nullable|url',
        ]);

        // Update data lapangan
        $field->update($data);

        return redirect()
            ->route('admin.fields.index')
            ->with('success', 'Lapangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Field $field)
    {
        $field->delete();

        return redirect()
            ->route('admin.fields.index')
            ->with('success', 'Lapangan berhasil dihapus');
    }
}
