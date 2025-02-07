<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\StudentReport;

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
            'teacher_id'     => 'required',
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
            $student->therapists()->attach($therapistIds);
        }
        //dd($request->filled('therapist_ids'));
        return response()->json($student, 201);
    }


    // Display the specified student.
    public function show($id)
    {
        $student = Student::with(['parent','teacher','class','therapists','school'])->find($id);

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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            //'email' => 'required|string|email|max:255|unique:students',
            'school_id' => 'required|integer',
            'birth_date' => 'date',
            //'parent_id' => 'required',    
            'neuro_class_id' => 'required',
            'teacher_id'     => 'required',
            'therapist_ids' => 'nullable|array',
            //'therapist_ids.*.id' => 'required|integer', // Ensure each therapist has an integer ID
        ],[
            //'parent_id.required' => 'The parent field is required',
            'neuro_class_id.required' => 'The class field is required',
            'school_id.required' => 'The school field is required. Please select a school.',
            'teacher_id.required' => 'Teacher field is required. Please select a teacher.',
            'therapist_ids.*.id.required' => 'Each therapist must have a valid ID.',
            //'therapist_ids.*.id.integer' => 'Each therapist ID must be an integer.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update student basic details
        $student->update($request->only(['first_name', 'last_name', 'email', 'school_id','neuro_class_id','updated_at',
                                         'birth_date','teacher_id','parent_id','condition','address','therapist_id','created_at']));

         // Extract therapist IDs and sync
         if ($request->filled('therapist_ids')) {
            $student->therapists()->sync($request->therapist_ids);
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

    /**
     * Get all reports for a specific student.
     */
    public function getReports($studentId) {
        $reports = StudentReport::with(['student', 'therapist'])
            ->where('student_id', $studentId)
            ->orderBy('report_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $reports
        ], 200);
    }

    /**
     * Store a new student report.
     */
    public function storeReport(Request $request)
    {
        try {
            // ✅ Validate Request Data
            $validated = $request->validate([
                'student_id'   => 'required|exists:students,id',
                'therapist_id' => 'required|exists:therapists,id',
                'report_title' => 'required|string|max:255',
                'file'         => 'required|file|max:10240', // Max 10MB
                'notes'        => 'nullable|string',
                'report_date'  => 'required|date',
            ]);

            $student = Student::findOrFail($request->student_id); // Fetch student by ID
            // ✅ Handle File Upload
            $file = $request->file('file');
            $folderName = Str::slug($student->first_name . ' ' . $student->last_name, '_'); // Generate safe folder name
            $filePath = $file->store("student_reports/{$folderName}", 'public'); // Save in public storage
            $fileType = $file->getClientMimeType();
            $fileSize = $file->getSize();

            // ✅ Save Report Data
            $report = StudentReport::create([
                'student_id'   => $validated['student_id'],
                'therapist_id' => $validated['therapist_id'],
                'report_title' => $validated['report_title'],
                'file_path'    => $filePath,
                'file_type'    => $fileType,
                'file_size'    => $fileSize,
                'notes'        => $validated['notes'] ?? null,
                'report_date'  => $validated['report_date'],
            ]);

            return response()->json([
                'message' => 'Report uploaded successfully!',
                'report'  => $report
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to upload report',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}