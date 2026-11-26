<?php

namespace App\Models\Plans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanFeature extends Model
{
    protected $table = 'plan_features';

    protected $fillable = [
        'plan_id',
        'max_exams',
        'max_laboratories',
        'max_users',
        'max_branches',
        'reports',
        'financial_management',
        'custom_branding',
        'data_export',
    ];

    protected function casts(): array
    {
        return [
            'max_exams' => 'integer',
            'max_laboratories' => 'integer',
            'max_users' => 'integer',
            'max_branches' => 'integer',

            'reports' => 'boolean',
            'financial_management' => 'boolean',
            'custom_branding' => 'boolean',
            'data_export' => 'boolean',
        ];
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
