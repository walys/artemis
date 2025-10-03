<?php

namespace App\Services\Company;

use App\Models\Company\Filial;

class FilialService
{

    public function createFilial($company)
    {
        $dataFilial = [
            'cnpj' => $company->cnpj,
            'company_id' => $company->id,
            'country_id' => $company->country_id,
            'type_filial_id' => 1,
            'number_users' => 1,
            'name' => $company->name,
            'slug' => $company->slug,
            'email' => $company->email,
            'phone' => $company->phone,
            'street' => $company->street,
            'number' => $company->number,
            'district' => $company->district,
            'city' => $company->city,
            'state' => $company->state,
            'details' => $company->details,
            'cep' => $company->cep,
            
        ];

        $filial = Filial::create($dataFilial);
        return $filial;
    }
}