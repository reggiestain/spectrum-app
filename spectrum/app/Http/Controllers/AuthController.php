<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $user->createToken('appToken')->plainTextToken
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials'
        ], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required',
            'school_id' => 'required',
            //'password' => 'required|string|min:8',
        ], [
            'role_id.required' => 'The role field is required. Please select a role.',
            'school_id.required' => 'The school field is required. Please select a school.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'birth_date' => $request->birth_date ?? "",
            'email' => $request->email,
            'school_id' => $request->school_id,
            'role_id' => $request->role_id,
            'status'=>'Active',
            'lastlogin'=>Carbon::now(),
            'password' => Hash::make('test123#'),
        ]);

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $user->createToken('appToken')->plainTextToken
        ]);
    }

    public function getUsers(Request $request)
    {
        $perPage = $request->query('perPage', 10); // Default to 10 users per page
        $page = $request->query('page', 1); // Default to page 1

        $users = User::with(['Role','School'])->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'users' => $users->items(),
            'total' => $users->total(),
            'perPage' => $users->perPage(),
            'currentPage' => $users->currentPage(),
            'lastPage' => $users->lastPage(),
        ]);
    }

    // Update an existing user
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'school_id' => 'required|exists:schools,id', // Ensure school exists
            'role_id' => 'required|exists:roles,id',     // Ensure role exists
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Update user information
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone ?? $user->phone,
            'school_id' => $request->school_id ?? $user->school_id,
            'role_id' => $request->role_id ?? $user->role_id,
            'birth_date' => $request->birth_date ?? $user->birth_date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
        ]);
    }

    // Delete a user
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Delete the user
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
