<?php

namespace App\Services\AccountSettings;

use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;


class AccountSettingService
{
    use HttpResponses;

    public function __construct()
    {
    }

    public function getAccountSettings()
    {
        $user = Auth::user();
        $userAccount = User::where('id', $user->id)->with('country', 'company', 'language')->first();
        return $userAccount;
    }

    public function save(Request $request)
    {
        try{

            return response()->json([
                'success' => true,
                'message' => 'Cadastrado com sucesso!',
                'data' => $request,
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [
                    'message' => 'Erro ao criar usuário',
                ],
            ], 422);
        }
    }
}