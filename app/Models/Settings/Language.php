<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'name',
        'code',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}