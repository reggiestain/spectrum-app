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
            'password' => 'required|string|min:8',
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
            'lastlogin'=>Carbon::now(),
            'password' => Hash::make($request->password),
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
}
