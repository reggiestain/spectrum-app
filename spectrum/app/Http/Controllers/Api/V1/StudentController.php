<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // Display a listing of students.
    public function index(Request $request)
    {
        // Get the current page and per page limit from the request
        $perPage = $request->query('perPage', 10); // Default to 10 items per page
        $page = $request->query('page', 1); // Default to page 1

        // Fetch paginated therapists
        $students = Student::with(['parent','teacher','class','therapist','school'])->
                            paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'students' => $students->items(),
            'total' => $students->total(),
            'perPage' => $students->perPage(),
            'currentPage' => $students->currentPage(),
            'lastPage' => $students->lastPage(),
        ]);
    }

    // Store a newly created student in storage.
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            //'email' => 'required|string|email|max:255|unique:students',
            'school_id' => 'required|integer',
            'birth_date' => 'date',
            //'parent_id' => 'required',    
            'neuro_class_id' => 'required'
        ],[
            //'parent_id.required' => 'The parent field is required',
            'neuro_class_id.required' => 'The class field is required',
            'school_id.required' => 'The school field is required. Please select a school.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Create student
        $student = Student::create($request->all());

        return response()->json($student, 201);
    }


    // Display the specified student.
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    // Update the specified student in storage.
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'surname' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:students,email,' . $id,
            'school_id' => 'sometimes|required|integer',
            'birth_date' => 'sometimes|required|date',
            'therapists' => 'array',
            'therapists.*' => 'exists:therapists,id',
            'parents' => 'array',
            'parents.*' => 'exists:parents,id',
            'class_types' => 'array',
            'class_types.*' => 'exists:class_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update student
        $student->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully.',
        ]);
    }


    // Remove the specified student from storage.
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}