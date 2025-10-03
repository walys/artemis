<?php

namespace App\Http\Controllers\api\V1\utils;

use App\Http\Controllers\Controller;
use App\Models\address\Country;

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