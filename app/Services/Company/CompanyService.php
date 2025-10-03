<?php

namespace App\Services\Company;

use App\Models\address\Country;
use App\Models\Company\Company;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Request;

class CompanyService
{
    protected $httpClient;

    public function __construct(Factory $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function createCompany(Request $request): Company
    {
        $companyApi = $this->getApiCnpj($request->cnpj);
        $dataCompany = $this->createDataCompany($request, $companyApi);

        $company = Company::create($dataCompany['dataCompany']);
        if(!$dataCompany['companyApiExist']){
            $this->createSlugCompany($company);
        }
        return $company;
    }

    private function createDataCompany(Request $request, $companyApi)
    {
        $countryId = Country::where('id', $request->country['value'])->first();
        $companyApiExist = false;

        if(!$companyApi){
            $dataCompany = [
                'cnpj' => removerCaracteresCNPJ($request->cnpj),
                'country_id' => $countryId->id,
                'number_users' => 1,
                'name' => 'My lab',
                'email' => $request->email,
                'phone' => '(00) 0000-0000',
                'address' => 'Não informado',
                'street' => 'Não informado',
                'number' => 0,
                'district' => 'Não informado',
                'city' => 'Não informado',
                'state' => 'Não informado',
                'details' => 'Não informado',
                'cep' => 'Não informado',
            ];
        }else{
            $companyApiExist = true;
            $companyApi = json_decode($companyApi, true);
            $dataCompany = [
                'cnpj' => removerCaracteresCNPJ($request->cnpj),
                'country_id' => $countryId->id,
                'number_users' => 1,
                'name' => $companyApi['company']['name'],
                'slug' => createSlug($companyApi['company']['name']),
                'email' => $request->email,
                'phone' => $companyApi['phones'] ? $companyApi['phones'][0]['area'] . ' ' . $companyApi['phones'][0]['number'] : '(00) 0000-0000',
                'street' => $companyApi['address'] ? $companyApi['address']['street'] : 'Não informado',
                'number' => $companyApi['address'] ? $companyApi['address']['number'] : 0,
                'district' => $companyApi['address'] ? $companyApi['address']['district'] : 'Não informado',
                'city' => $companyApi['address'] ? $companyApi['address']['city'] : 'Não informado',
                'state' => $companyApi['address'] ? $companyApi['address']['state'] : 'Não informado',
                'details' => $companyApi['address'] ? $companyApi['address']['details'] : 'Não informado',
                'cep' => $companyApi['address'] ? $companyApi['address']['zip'] : 'Não informado',
            ];
        }

        return ['companyApiExist' => $companyApiExist, 'dataCompany' => $dataCompany];   
    }

    public function createSlugCompany($company) 
    {
        $slug = $company->name . '-' . $company->id;
        $company->slug = $slug;
        $company->save();
        return $company;
    }

    /**
     * Retrieves information from the CNPJ API for a given CNPJ number.
     *
     * @param string $cnpj The CNPJ number to query.
     * @return string The response body from the API, or an error code if the request was unsuccessful.
     */
    public function getApiCnpj($cnpj): string
    {
        $cnpj = removerCaracteresCNPJ($cnpj);
        $url = 'https://open.cnpja.com/office/' . $cnpj;

        $response = $this->httpClient->get($url, ['verify' => false]);

        if (!$response->successful()) {
            return $response['code'];
        }

        return $response->body();
    }

}