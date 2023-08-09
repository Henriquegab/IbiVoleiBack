<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'message' => "Usuários recuperados!",
            'data'=> $users
        ]);
    }

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);



        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message'=>'Credenciais Inválidas!'
                ],401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message'=>'O Token não pôde ser criado',
                'data' => $e
                ],500);
        }

        $user = auth()->user();

        $usuario = User::where('id',auth()->user()->id)->first();

        return response()->json([
            'success' => true,
            'message'=>'Logado com sucesso!',
            'data' => [
                'token' => $token,
                'user' => $user,
                // 'role' => $usuario->getRoleNames(),
                // 'permissions' => $usuario->getAllPermissions()
                ]
        ],200);
    }

    public function register(StoreUserRequest $request)
    {

        try{

            $user = User::create($request->all());

            return response()->json([
                'success' => true,
                'message'=>'Usuário criado com sucesso!',
                'data' => $user
            ],201);



        }

        catch(Exception $e){
            return response()->json([
                'success' => false,
                'message'=>'erro',
                'data' => $e
            ],500);
        }


    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'success' => true,
            'message' => "usuário logado com sucesso!",
            'token' => $token,

        ]);
    }
}
