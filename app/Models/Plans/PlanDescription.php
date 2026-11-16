<?php

namespace App\Models\Plans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanDescription extends Model
{
    protected $fillable = [
        'plan_id',
        'language_id',
        'description',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\Settings\Language::class
        );
    }
}