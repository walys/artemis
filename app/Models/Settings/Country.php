<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Company;
use App\Models\Company\Filial;
use App\Models\Auth\User;

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

    public function users()
    {
        return $this->hasMany(User::class);
    }
}