<?php

namespace App\Models\address;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Company;
use App\Models\Company\Filial;

class Country extends Model
{
    protected $table = "countries";

    protected $fillable = [
        'id',
        'name',
        'code',
        'capital',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function filials()
    {
        return $this->hasMany(Filial::class);
    }
}