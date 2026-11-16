<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plans\PlanDescription;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'name',
        'code',
    ];

    public function planDescriptions(): HasMany
    {
        return $this->hasMany(PlanDescription::class);
    }
}