<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_emp_id' => $request->user_emp_id,
            'isAdmin' => $request->status
        ]);

        return $user;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials'
            ]);
        }

        $request->session()->regenerate();

        return response()->json(null, 201);
    }

    public function logout(Request $request)
    {
        auth()->guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(null, 200);
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function getalluser()
    {
        return User::all();
    }

    // get data from join employee
    public function getdatajoinemployee()
    {
        return DB::table('users')->leftJoin('employees', 'users.user_emp_id', '=', 'employees.emp_id')->get();
    }

    // delete user
    public function deleteuser($userid)
    {
        DB::table('users')
            ->where('id', $userid)
            ->delete();

        return ["result: " => "Delete success!"];
    }
}
