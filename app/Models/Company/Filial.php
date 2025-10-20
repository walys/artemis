<?php

namespace App\Models\Company;

use App\Models\Settings\Country;
use App\Models\Auth\UserFilialCompany;
use App\Models\Company\Company;
use App\Models\Company\TypeFilial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'company_id',
        'type_filial_id',
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function typeFilial()
    {
        return $this->belongsTo(TypeFilial::class, 'type_filial_id');
    }

    // Defina a relação com a model UserFilialCompany
    public function userFilialCompanies()
    {
        return $this->hasMany(UserFilialCompany::class, 'filial_id');
    }
}