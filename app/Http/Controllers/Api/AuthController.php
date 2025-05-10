<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Registrar nuevo usuario
    public function registrar(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users',
            'contraseña' => 'required|string|min:6|confirmed',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'éxito' => false, 
                'errores' => $validador->errors()
            ], 422);
        }

        $usuario = User::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña),
        ]);

        $token = JWTAuth::fromUser($usuario);

        return response()->json([
            'éxito' => true,
            'usuario' => $usuario,
            'token' => $token
        ], 201);
    }

    // Iniciar sesión
    public function iniciarSesion(Request $request)
    {
        $credenciales = $request->only('correo', 'contraseña');

        if (!$token = JWTAuth::attempt($credenciales)) {
            return response()->json([
                'éxito' => false, 
                'mensaje' => 'Credenciales inválidas'
            ], 401);
        }

        return response()->json([
            'éxito' => true,
            'token' => $token
        ]);
    }

    // Cerrar sesión
    public function cerrarSesion()
    {
        auth()->logout();

        return response()->json([
            'éxito' => true, 
            'mensaje' => 'Sesión cerrada correctamente'
        ]);
    }

    // Obtener usuario autenticado
    public function miUsuario()
    {
        return response()->json([
            'éxito' => true,
            'usuario' => auth()->user()
        ]);
    }
}