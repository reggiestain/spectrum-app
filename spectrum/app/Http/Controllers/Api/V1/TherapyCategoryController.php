<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\TherapyCategory;
use Illuminate\Http\Request;

class TherapyCategoryController extends Controller
{
    // Display a listing of therapy categories
    public function index()
    {
        $therapyCategories = TherapyCategory::all();
        return response()->json($therapyCategories, 200);
    }

    // Store a newly created therapy category in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $therapyCategory = TherapyCategory::create([
            'name' => $request->input('name')
        ]);

        return response()->json([
            'message' => 'Therapy Category created successfully!',
            'data' => $therapyCategory
        ], 201);
    }

    // Display the specified therapy category
    public function show($id)
    {
        $therapyCategory = TherapyCategory::findOrFail($id);
        return response()->json($therapyCategory, 200);
    }

    // Update the specified therapy category in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $therapyCategory = TherapyCategory::findOrFail($id);
        $therapyCategory->update([
            'name' => $request->input('name')
        ]);

        return response()->json([
            'message' => 'Therapy Category updated successfully!',
            'data' => $therapyCategory
        ], 200);
    }

    // Remove the specified therapy category from the database
    public function destroy($id)
    {
        $therapyCategory = TherapyCategory::findOrFail($id);
        $therapyCategory->delete();

        return response()->json([
            'message' => 'Therapy Category deleted successfully!'
        ], 200);
    }
}
