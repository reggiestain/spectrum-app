<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\ParentModel; // Assuming you have a Parent model
use Illuminate\Http\Request;

class ParentController extends Controller
{
    // List all parents
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Default to 10 per page
        $parents = ParentModel::paginate($perPage);
        return response()->json([
            'parents' => $parents->items(),  // Actual data
            'currentPage' => $parents->currentPage(),
            'total' => $parents->total(),
            'perPage' => $parents->perPage(),
        ], 200);
    }

    // Show a specific parent by ID
    public function show($id)
    {
        $parent = ParentModel::find($id);

        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        return response()->json(['parent' => $parent], 200);
    }

    // Store a new parent
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:parents,email',
            'phone' => 'required|unique:parents,phone',
            // Add more fields as needed
        ]);

        $parent = ParentModel::create($validatedData);

        return response()->json(['parent' => $parent], 201);
    }

    // Update an existing parent
    public function update(Request $request, $id)
    {
        $parent = ParentModel::find($id);

        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'phone' => 'string|max:15',
            'email' => 'email|unique:parents,email,' . $parent->id,
            // Add more fields as needed
        ]);

        $parent->update($validatedData);

        return response()->json(['parent' => $parent], 200);
    }

    // Delete a parent
    public function destroy($id)
    {
        $parent = ParentModel::find($id);

        if (!$parent) {
            return response()->json(['message' => 'Parent not found'], 404);
        }

        $parent->delete();

        return response()->json(['message' => 'Parent deleted successfully'], 200);
    }
}
