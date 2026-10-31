<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMasterSetting extends Model
{
    protected $table = 'user_master_settings';

    protected $fillable = [
        'user_master_id',
        'language',
        'theme',
        'notifications',
    ];

    protected function casts(): array
    {
        return [
            'notifications' => 'boolean',
        ];
    }

    public function userMaster(): BelongsTo
    {
        return $this->belongsTo(UserMaster::class, 'user_master_id');
    }
}
