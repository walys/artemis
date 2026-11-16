<?php

namespace App\Models\Plans;

use App\Models\Subscriptions\CompanySubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyPlanOverride extends Model
{
    protected $table = 'company_plan_overrides';

    protected $fillable = [
        'company_subscription_id',
        'override_key',
        'override_value',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'override_value' => 'json',
        ];
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(
            CompanySubscription::class,
            'company_subscription_id'
        );
    }
}
