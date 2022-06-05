<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function  CheckLogin(Request $request)
    {
        $login = User::where('login', '=', $request->login)->first();
        if ($login) {
            if ($login->password == $request->password) {
                return response()->json(['token' => $login->generateToken()], 200);
            }
            return response()->json(['data' => 'Логин занят'], 200);
        }
        return response()->json(['data' => 'Логин свободен'], 200);
    }
    public function register(Request $request)
    {

        $messages = [
            'name' => 'Имя',
            'password' => 'Пароль',
            'login' => 'Логин',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'login' => 'required|unique:users',
            'password' => 'required|min:5',
        ]);
        $validator->setAttributeNames($messages);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        User::create($request->all());
        return response()->json()->setStatusCode(204);
    }
    function authCheck()
    {
        return  response()->json([
            'data' => Auth::user()->name
        ], 200);
    }
}
