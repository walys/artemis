<?php

namespace App\Models\Company;

use App\Models\address\Country;
use App\Models\auth\UserFilialCompany;
use App\Models\Company\Filial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'country_id',
        'name',
        'cnpj',
        'slug',
        'website',
        'description',
        'number_users',
        'street',
        'number',
        'district',
        'city',
        'state',
        'details',
        'cep',
        'created_by',
        'updated_by',
    ];

    public function filials()
    {
        return $this->hasMany(Filial::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Defina a relação com a model UserFilialCompany
    public function userFilialCompanies()
    {
        return $this->hasMany(UserFilialCompany::class, 'company_id');
    }
}