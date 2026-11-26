<?php

namespace App\Models\Plans;

use App\Models\Subscriptions\CompanySubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Plan extends Model
{
    protected $table = 'plans';

    protected $fillable = [
        'name',
        'code',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function features(): HasOne
    {
        return $this->hasOne(PlanFeature::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(PlanPrice::class);
    }

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PlanPaymentMethod::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(CompanySubscription::class);
    }

    public function descriptions(): HasMany
    {
        return $this->hasMany(PlanDescription::class);
    }
}
