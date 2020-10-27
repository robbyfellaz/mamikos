<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class RegisterController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('register');
        }
    }

    public function store(Request $request)
    {
        $nama_lengkap = $request->input('nama_lengkap');
        $email        = $request->input('email');
        $type_user    = $request->input('type_user');
        $password     = $request->input('password');

        $creditPoint = User::REGULAR_POINT;
        if ($type_user == 3) {
            $creditPoint = User::PREMIUM_POINT;
        } else if ($type_user == 1) {
            $creditPoint = 0;
        }

        $user = User::create([
            'name' => $nama_lengkap,
            'email' => $email,
            'type_user' => $type_user,
            'credit_points' => $creditPoint,
            'password' => Hash::make($password)
        ]);

        if($user) {
            if(Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
                return response()->json([
                    'success' => true
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Gagal!'
            ], 400);
        }
    }
}
