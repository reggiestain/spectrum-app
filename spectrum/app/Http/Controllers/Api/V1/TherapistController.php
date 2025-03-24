<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Therapist;
use Illuminate\Support\Facades\Validator;
use App\Models\StudentReport;

class TherapistController extends Controller
{
    // Fetch paginated therapists
    public function index(Request $request)
    {
        // Get the current page and per page limit from the request
        $perPage = $request->query('perPage', 10); // Default to 10 items per page
        $page = $request->query('page', 1); // Default to page 1

        // Fetch paginated therapists
        $therapists = Therapist::with(['category'])->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'therapists' => $therapists->items(),
            'total' => $therapists->total(),
            'perPage' => $therapists->perPage(),
            'currentPage' => $therapists->currentPage(),
            'lastPage' => $therapists->lastPage(),
        ]);
    }

    // Get total student count
    public function getTherapistCount()
    {
        $count = Therapist::count();

        return response()->json([
            'total_therapists' => $count
        ], 200);
    }

    // Fetch a single therapist by ID
    public function show($id)
    {
        $therapist = Therapist::find($id);

        if (!$therapist) {
            return response()->json(['message' => 'Therapist not found'], 404);
        }

        return response()->json($therapist);
    }

    // Create a new therapist
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:therapists',
            'phone' => 'nullable|string|max:15',
            'specialization' => 'required|string|max:255',
            'therapy_category_id' => 'required',
            'school_id' => 'required',
        ], [
            'specialization.required' => 'The position field is required',
            'therapy_category_id.required' => 'The specialization field is required. Please select a category.',
            'school_id.required' => 'The school field is required. Please select a school.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $therapist = Therapist::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'specialization' => $request->specialization,
            'bio' => $request->bio,
            'therapy_category_id' => $request->therapy_category_id,
            'school_id' => $request->school_id
        ]);

        return response()->json($therapist, 201);
    }

    // Update an existing therapist
    public function update(Request $request, $id)
    {
        $therapist = Therapist::find($id);

        if (!$therapist) {
            return response()->json(['message' => 'Therapist not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:therapists,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
            'specialization' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $therapist->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Therapist updated successfully',
        ]);
    }

    // Delete a therapist
    public function destroy($id)
    {
        $therapist = Therapist::find($id);

        if (!$therapist) {
            return response()->json(['message' => 'Therapist not found'], 404);
        }

        $therapist->delete();

        return response()->json(['message' => 'Therapist deleted successfully']);
    }

    public function uploadReport(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'therapist_id' => 'required|exists:therapists,id',
            'report_file' => 'required|file|max:102400', // Max file size 100MB
        ]);

        $file = $request->file('report_file');
        $filePath = $file->store('reports', 'public');
        $fileType = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();

        // Save the report in the database
        $report = StudentReport::create([
            'student_id' => $request->student_id,
            'therapist_id' => $request->therapist_id,
            'report_title' => $request->input('report_title', 'Untitled Report'),
            'file_path' => $filePath,
            'file_type' => $fileType,
            'file_size' => $fileSize,
            'report_date' => now(),
        ]);

        return response()->json(['message' => 'Report uploaded successfully', 'report' => $report]);
    }

}
