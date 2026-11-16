<?php

namespace App\Models\Settings;

use App\Models\Companies\Company;
use App\Models\Companies\Filial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'code',
        'capital',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function filials(): HasMany
    {
        return $this->hasMany(Filial::class);
    }
}
