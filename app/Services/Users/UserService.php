<?php

namespace App\Services\users;

use App\Models\auth\User;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct()
    {

    }

    public function dataUser($id)
    {
        $dataUser = User::with('company', 'accessLevel')->where('id', $id)->get();
        $user = Auth::user();
        session()->put('users', $dataUser);
        return $dataUser;
    }

    public function createUser(Request $request, $company, $filial)
    {
        $hashedPassword = Hash::make($request->email);
        $user = User::create([
            'email' => $request->email,
            'password' => $hashedPassword,
            'company_id' => $company->id,
            'name' => 'User ' . $company->name,
            'access_level_id' => 2,
            'celular' => '(00) 0000-0000',
            'foto' => 'https://cdn-icons-png.flaticon.com/512/149/149071.png',
        ]);

        return $user;
    }
}