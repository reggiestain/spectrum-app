<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // List all teachers
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Default to 10 per page
        $teachers = Teacher::paginate($perPage);
        return response()->json([
            'teachers' => $teachers->items(),  // Actual data
            'currentPage' => $teachers->currentPage(),
            'total' => $teachers->total(),
            'perPage' => $teachers->perPage(),
        ], 200);
    }

    // Show a specific teacher by ID
    public function show($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        return response()->json(['teacher' => $teacher], 200);
    }

    // Store a new teacher
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'required|string|max:15',
            // Add more fields as needed
        ]);

        $teacher = Teacher::create($validatedData);

        return response()->json(['teacher' => $teacher], 201);
    }

    // Update an existing teacher
    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:teachers,email,' . $teacher->id,
            'phone' => 'string|max:15',
            // Add more fields as needed
        ]);

        $teacher->update($validatedData);

        return response()->json(['teacher' => $teacher], 200);
    }

    // Delete a teacher
    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $teacher->delete();

        return response()->json(['message' => 'Teacher deleted successfully'], 200);
    }
}
