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
use App\Models\Company\Company;

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
                'authorized' => false,
                'status' => "422",
                'errors' => "Email incorreto!"
            ];
            return response()->json($error);
        }

        if(Auth::attempt($request->only('email', 'password'))) {
            $token = $request->user()->createToken('access_token');
            $dataUser = $this->userService->dataUser($token->accessToken['tokenable_id']);

            $data = [
                'authorized' => true,
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
                'authorized' => false,
                'status' => "422",
                'errors' => "Senha incorreta!"
            ];
            return response()->json($error);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'cnpj' => 'required',
            'country' => 'required',
        ]);

        Company::where('cnpj', removerCaracteresCNPJ($request->cnpj))
        ->orWhere('email', $request->email)
        ->first() ? $companyExist = true : $companyExist = false;

        if($companyExist) {
            $error = [
                'authorized' => false,
                'status' => "422",
                'errors' => "CNPJ  ou E-mail ja cadastrado!"
            ];
            return response()->json($error);
        }

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
}
