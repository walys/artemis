<?php

namespace App\Models\Companies;

use App\Models\Settings\Country;
use App\Models\Companies\Filial;
use App\Models\Subscriptions\CompanySubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'country_id',
        'name',
        'cnpj',
        'website',
        'description',
        'street',
        'number',
        'district',
        'city',
        'state',
        'details',
        'cep',
        'phone',
        'created_by',
        'updated_by',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function filials(): HasMany
    {
        return $this->hasMany(Filial::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(CompanySubscription::class);
    }
}
