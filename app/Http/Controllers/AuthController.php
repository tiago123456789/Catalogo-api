<?php

namespace App\Http\Controllers;


use App\Http\Requests\AuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(AuthRequest $request) {
        $credenciais = $request->only(["email", "password"]);
        $token = JWTAuth::attempt($credenciais);

        if ($token) {
            return response()->json([ "access_token" => $token ]);
        }

        return response()->json(["message" => "Credenciais inválidas!"], 401);
    }

    public function logout() {
        auth()->logout();
        return response()->json("", 204);
    }

    public function refresh() {
        $newToken = JWTAuth::refresh();
        return response()->json([ "access_token" => $newToken ]);
    }
}
