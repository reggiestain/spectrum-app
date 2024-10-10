<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Get all Roles
    public function index()
    {
        return response()->json(Role::all(), 200);
    }

    // Get a single Role
    public function show($id)
    {
        $school = School::find($id);

        if (!$school) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json($school, 200);
    }

    // Create a new school
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::create($request->all());

        return response()->json($role, 201);
    }

    // Update an existing role
    public function update(Request $request, $id)
    {
        $school = School::find($id);

        if (!$school) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $school->update($request->all());

        return response()->json($school, 200);
    }

    // Delete a role
    public function destroy($id)
    {
        $school = School::find($id);

        if (!$school) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $school->delete();

        return response()->json(['message' => 'Role deleted'], 200);
    }
}
