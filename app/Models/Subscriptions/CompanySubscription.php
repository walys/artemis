<?php

namespace App\Models\Subscriptions;

use App\Models\Companies\Company;
use App\Models\Plans\Plan;
use App\Models\Plans\PlanPrice;
use App\Models\Plans\CompanyPlanOverride;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanySubscription extends Model
{
    protected $table = 'company_subscriptions';

    protected $fillable = [
        'company_id',
        'plan_id',
        'plan_price_id',
        'currency',
        'billing_interval',
        'amount',
        'status',
        'started_at',
        'current_period_start',
        'current_period_end',
        'trial_ends_at',
        'cancel_at_period_end',
        'canceled_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'cancel_at_period_end' => 'boolean',
            'started_at' => 'datetime',
            'current_period_start' => 'datetime',
            'current_period_end' => 'datetime',
            'trial_ends_at' => 'datetime',
            'canceled_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function planPrice(): BelongsTo
    {
        return $this->belongsTo(PlanPrice::class);
    }

    public function overrides(): HasMany
    {
        return $this->hasMany(CompanyPlanOverride::class, 'company_subscription_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(SubscriptionPayment::class);
    }
}
