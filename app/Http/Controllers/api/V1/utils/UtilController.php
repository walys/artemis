<?php

namespace App\Http\Controllers\api\V1\utils;

use App\Http\Controllers\Controller;
use App\Models\Settings\Country;
use App\Models\Settings\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;


class UtilController extends Controller
{
    public function getCountries()
    {
        $country = Country::select('id as value', 'name as label')
        ->orderBy('name')
        ->get();
        $countries = $country->toArray();

        return response()->json($countries);
    }

    public function getLanguages()
    {
        $language = Language::select('id as value', 'name as label', 'code')
        ->orderBy('name')
        ->get();
        $languages = $language->toArray();

        return response()->json($languages);
    }

    public function changeLanguage(Request $request)
    {
        try{
            $userAuth = Auth::user();
            $user = User::find($userAuth->id);
            if($user->language_id == $request->language['value']){
                $data = [
                    'authorized' => true,
                    'message' => 'Idioma atual'
                ];
                return response()->json($data);
            }
            $user->language_id = $request->language['value'];
            $user->save();

            $data = [
                'authorized' => true,
                'message' => 'Idioma alterado com sucesso!',
                'language' => $request->language
            ];
            
            return response()->json($data);
        }catch(\Exception $e){
            $error = [
                'status' => "422",
                'errors' => $e->getMessage()
            ];
            return response()->json($error);
        }
        
    }

    public function getCep($cep)
    {
        $cep = str_replace('-', '', $cep);
        $cep = str_replace('.', '', $cep);
        $cep = str_replace(' ', '', $cep);

        $url = "https://viacep.com.br/ws/{$cep}/json/";

        $response = file_get_contents($url);
        $json = json_decode($response);

        return response()->json($json);
    }
}