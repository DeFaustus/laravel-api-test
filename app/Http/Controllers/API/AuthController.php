<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);
        $data = $validate->validated();
        if (!Auth::attempt($data)) {
            return response()->json([
                'status'   =>  'Gagal',
                'message'   =>  'user tidak ditemukan',
            ]);
        }
        $user = User::where('email', Auth::user()->email)->first();
        $token = $user->createToken('token-auth')->plainTextToken;
        $respon = [
            'code'  => 200,
            'status' => true,
            'data' => [
                'token' => $token,
                'user' => [
                    'id'    => $user->id,
                    'email'    => $user->email,
                ]
            ]
        ];
        return response()->json($respon, 200);
    }
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama'      =>  'required',
            'email'     =>  'required',
            'password'  =>  'required'
        ]);
        $validated = $validate->validated();
        $validated['password'] = Hash::make($validated['password']);
        try {
            $user = User::create($validated);
            return response()->json([
                'code'  => 200,
                'status'    =>  true,
                'data'  => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'    =>  'gagal',
                'message'   =>  $th->getMessage()
            ]);
        }
    }
}
