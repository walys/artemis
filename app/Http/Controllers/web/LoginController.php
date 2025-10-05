<?php

namespace App\Http\Controllers\web;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Services\Auth\AuthService;
use App\Services\users\UserService;

class Logincontroller extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    private $authService;
    private $userService;

    function __construct(AuthService $authService, UserService $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function index()
    {
        //dd(Auth::user());
        return Inertia::render('login/Login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Verifica se o usuário existe
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $error = [
                'message' => "Not Authorized",
                'status' => "403",
                'error' => "Email incorreto!"
            ];
            return response()->json($error
            );
        }

        if(Auth::attempt($request->only('email', 'password'))) {
            $token = $request->user()->createToken('access_token');
            $dataUser = $this->userService->dataUser($token->accessToken['tokenable_id']);

            $data = [
                'message' => "Authorized",
                'token' => $token->plainTextToken,
                'name' => $dataUser->first()->name,
                'email' => $dataUser->first()->email,
                'id' => $dataUser->first()->id
            ];

            return response()->json([
                $data
            ],
            200
            );
        }else{
            $error = [
                'message' => "Not Authorized",
                'status' => "403",
                'error' => "Senha incorreta!"
            ];
            return response()->json($error);
        }
    }
}
