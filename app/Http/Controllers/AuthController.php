<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

    public function change_password(Request $request)
    {

        $input = $request->all();
        $userid = $request->user_id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
            return $arr;
        } else {

            try {

                $user_pw = DB::table('users')
                    ->select('password')
                    ->where('id', '=', $request->user_id)
                    ->get();
                $getpw = $user_pw[0]->password;

                if (Hash::check(request('old_password'), $getpw) == false) {
                    $arr = array("status" => 400, "message" => "ກະລຸນາປ້ອນລະຫັດປະຈຸບັນຂອງທ່ານໃຫ້ຖືກຕ້ອງ!", "data" => array());

                    return $arr;
                } else if (Hash::check(request('new_password'), $getpw) == true) {
                    $arr = array("status" => 400, "message" => "ກະລຸນາປ້ອນລະຫັດທີ່ຕ່າງຈາກລະຫັດເກົ່າຂອງທ່ານ!", "data" => array());

                    return $arr;
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "ປ່ຽນລະຫັດສຳເລັດ.", "data" => array());

                    return $arr;
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());

                return $arr;
            }
        }
    }
}
