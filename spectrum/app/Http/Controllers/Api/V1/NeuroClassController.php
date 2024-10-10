<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\NeuroClass;
use Illuminate\Http\Request;

class NeuroClassController extends Controller
{
    // List all class types
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Default to 10 per page
        $NeuroClasss = NeuroClass::paginate($perPage);
        return response()->json([
            'NeuroClass' => $NeuroClasss->items(),  // Actual data
            'currentPage' => $NeuroClasss->currentPage(),
            'total' => $NeuroClasss->total(),
            'perPage' => $NeuroClasss->perPage(),
        ], 200);
    }

    // Show a specific class type by ID
    public function show($id)
    {
        $NeuroClass = NeuroClass::find($id);

        if (!$NeuroClass) {
            return response()->json(['message' => 'Class type not found'], 404);
        }

        return response()->json(['NeuroClass' => $NeuroClass], 200);
    }

    // Store a new class type
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $NeuroClass = NeuroClass::create($validatedData);

        return response()->json(['NeuroClass' => $NeuroClass], 201);
    }

    // Update an existing class type
    public function update(Request $request, $id)
    {
        $NeuroClass = NeuroClass::find($id);

        if (!$NeuroClass) {
            return response()->json(['message' => 'Class type not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
        ]);

        $NeuroClass->update($validatedData);

        return response()->json(['NeuroClass' => $NeuroClass], 200);
    }

    // Delete a class type
    public function destroy($id)
    {
        $NeuroClass = NeuroClass::find($id);

        if (!$NeuroClass) {
            return response()->json(['message' => 'Class type not found'], 404);
        }

        $NeuroClass->delete();

        return response()->json(['message' => 'Class type deleted successfully'], 200);
    }
}
