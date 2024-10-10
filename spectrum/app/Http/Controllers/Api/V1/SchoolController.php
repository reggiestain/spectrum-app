<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    // Get all schools
    public function index()
    {
        return response()->json(School::all(), 200);
    }

    // Get a single school
    public function show($id)
    {
        $school = School::find($id);

        if (!$school) {
            return response()->json(['message' => 'School not found'], 404);
        }

        return response()->json($school, 200);
    }

    // Create a new school
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $school = School::create($request->all());

        return response()->json($school, 201);
    }

    // Update an existing school
    public function update(Request $request, $id)
    {
        $school = School::find($id);

        if (!$school) {
            return response()->json(['message' => 'School not found'], 404);
        }

        $school->update($request->all());

        return response()->json($school, 200);
    }

    // Delete a school
    public function destroy($id)
    {
        $school = School::find($id);

        if (!$school) {
            return response()->json(['message' => 'School not found'], 404);
        }

        $school->delete();

        return response()->json(['message' => 'School deleted'], 200);
    }
}
