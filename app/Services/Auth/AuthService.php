<?php

namespace App\Services\Auth;

use App\Models\auth\User;
use App\Models\auth\UserFilialCompany;
use App\Models\Company\Company;
use App\Services\Company\CompanyService;
use App\Services\Company\FilialService;
use App\Services\users\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AuthService
{
    protected $companyService;
    protected $filialService;
    protected $userService;
    
    function __construct(CompanyService $companyService, FilialService $filialService, UserService $userService)
    {
        $this->companyService = $companyService;
        $this->filialService = $filialService;
        $this->userService = $userService;
    }

    public function registerCompanyUser (Request $request) 
    {
        DB::beginTransaction();
        try {

            $emailExists = User::where('email', $request->email)->first();
            if ($emailExists) {
                throw new Exception('Email já cadastrado e não pode ser utilizado');
            }

            $cnpjExists = Company::where('cnpj', $request->cnpj)->first();
            if ($cnpjExists) {
                throw new Exception('CNPJ já cadastrado e não pode ser utilizado');
            }

            $company = $this->companyService->createCompany($request);
            if(!$company) {
                throw new Exception('Erro ao criar empresa. Entre em contato com o suporte!');
            }

            $filial = $this->filialService->createFilial($company);
            if(!$filial) {
                throw new Exception('Erro ao criar filial. Entre em contato com o suporte!');
            }

            $user = $this->userService->createUser($request, $company, $filial);
            if(!$user) {
                throw new Exception('Erro ao criar usuário. Entre em contato com o suporte!');
            }

            $userFilialCompany = UserFilialCompany::create([
                'user_id' => $user->id,
                'filial_id' => $filial->id,
                'company_id' => $company->id,
            ]);
            if(!$userFilialCompany) {
                throw new Exception('Erro ao criar permissão de acesso. Entre em contato com o suporte!');
            }

            $request->merge(['password' => $request->email]);
            $request->merge(['acess_user' => true]);

            DB::commit();

            if(Auth::attempt($request->only('email', 'password'))) {
                $token = $request->user()->createToken('access_token');
                $dataUser = $this->userService->dataUser($token->accessToken['tokenable_id']);
                return [
                    'Authorized' => true,
                    'message' => 'Authorized',
                    'token' => $token->plainTextToken,
                    'name' => $dataUser->first()->name,
                    'email' => $dataUser->first()->email,
                    'id' => $dataUser->first()->id,
                ];
            }else{
                throw new Exception('Erro ao criar usuário. Entre em contato com o suporte!');
            }

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

}
