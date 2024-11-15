<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        // Validación de los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Si la validación falla, devuelve un error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Creación del usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Creación del token para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        // Respuesta con los datos del usuario y el token
        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function login(Request $request)
    {
        // Validar que el email y la contraseña se proporcionen
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario con los datos proporcionados
        if (Auth::attempt($request->only('email', 'password'))) {
            // Buscar al usuario en la base de datos
            $user = User::where('email', $request->email)->firstOrFail();
            
            // Generar el token para el usuario
            $token = $user->createToken('auth_token')->plainTextToken;

            // Respuesta con el nombre, el token y el usuario
            return response()->json([
                'message' => 'Hi, ' . $user->name,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        }

        // Si la autenticación falla, devolver error
        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
    }
    public function logout()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Revocar todos los tokens del usuario
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        // Devolver respuesta de éxito
        return response()->json([
            'message' => 'true',
        ]);
    }
}
