<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\Auth\AuthService;
use App\Services\users\UserService;

class AuthController extends Controller
{
    use HttpResponses;

    private $authService;
    private $userService;

    function __construct(AuthService $authService, UserService $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        // $hashedPassword = Hash::make('123456');
        // dd($request->all(), $hashedPassword);
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Verifica se o usuário existe
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'error' => 'Email incorreto!',
            ],
            403
            );
        }

        if(Auth::attempt($request->only('email', 'password'))) {
            $token = $request->user()->createToken('access_token');
            $dataUser = $this->userService->dataUser($token->accessToken['tokenable_id']);

            return response()->json([
                'message' => 'Authorized',
                'token' => $token->plainTextToken,
                'name' => $dataUser->first()->name,
                'email' => $dataUser->first()->email,
                'id' => $dataUser->first()->id
            ],
            200
            );
        }else{
            return response()->json(['error' => 'Senha incorreta!'], 403);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'cnpj' => 'required',
            'country' => 'required',
        ]);

        try {
            $userAcessCreated = $this->authService->registerCompanyUser($request);
            return response()->json([$userAcessCreated], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [
                    'message' => 'Erro ao criar usuário',
                    'details' => $th->getMessage() . ' - ' . $th->getLine() . ' - ' . $th->getFile(),
                ],
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Token Revogado!', 200);
    }

    public function userAutenticated()
    {
        $user = Auth::user();
        $acess = session()->all();
        $user->company;
        $user->accessLevel;
        $user->country;
        $user->language;
        
        $names = explode(' ', $user->name);
        $firstName = $names[0];
        $secondName = $names[1];

        $userAutenticated = [
            'name'  => $firstName . ' ' . $secondName,
            'email' => $user->email,
            'cpf'   => $user->cpf,
            'foto'  => $user->foto,
            'company' => $user->company,
            'accessLevel' => $user->accessLevel,
            'country' => $user->country,
            'language' => $user->language
        ];

        return response()->json($userAutenticated, 200);
    }
}