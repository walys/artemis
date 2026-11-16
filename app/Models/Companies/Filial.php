<?php

namespace App\Models\Companies;

use App\Models\Settings\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Filial extends Model
{
    protected $table = 'filials';

    protected $fillable = [
        'company_id',
        'country_id',
        'name',
        'cnpj',
        'website',
        'description',
        'is_headquarters',
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

    protected function casts(): array
    {
        return [
            'is_headquarters' => 'boolean',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
