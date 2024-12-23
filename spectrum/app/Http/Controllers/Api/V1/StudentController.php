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
        $students = Student::with(['parent','teacher','class','therapists','school'])->
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
            'neuro_class_id' => 'required',
            'therapist_ids' => 'nullable|array',
            'therapist_ids.*.id' => 'required|integer', // Ensure each therapist has an integer ID
        ],[
            //'parent_id.required' => 'The parent field is required',
            'neuro_class_id.required' => 'The class field is required',
            'school_id.required' => 'The school field is required. Please select a school.',
            'teacher_id.required' => 'Teacher field is required. Please select a teacher.',
            'therapist_ids.*.id.required' => 'Each therapist must have a valid ID.',
            'therapist_ids.*.id.integer' => 'Each therapist ID must be an integer.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Create student
        $student = Student::create($request->only([
            'first_name', 'last_name', 'school_id', 'birth_date', 'neuro_class_id',
            'condition','parent_id','school_id','teacher_id','therapist_id'
        ]));

        // Extract therapist IDs and sync
        if ($request->filled('therapist_ids')) {
            $therapistIds = collect($request->therapist_ids)->pluck('id')->toArray(); // Extract only the IDs
            $student->therapists()->sync($therapistIds);
        }

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
            'birth_date' => 'sometimes|nullable|date',
            'therapist_ids' => 'array', // Allow therapist_ids as an array
            'therapist_ids.*.id' => 'exists:therapists,id', // Each therapist ID must exist in therapists table
            'teacher_id' => 'sometimes|required|integer',
            'teacher_id.*' => 'exists:teachers,id',
            'parent_id' => 'sometimes|required|integer',
            'parent_id.*' => 'exists:parents,id',
            'neuro_class_id' => 'sometimes|required|integer',
            'neuro_class_id.*' => 'exists:neuro_classes,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update student basic details
        $student->update($request->only(['first_name', 'last_name', 'email', 'school_id','neuro_class_id','updated_at',
                                         'birth_date','teacher_id','parent_id','condition','address','created_at']));

        // Update therapists relationship
        if ($request->has('therapist_ids')) {
            $student->therapists()->sync($request->therapist_ids); // Sync therapists with provided IDs
        }

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