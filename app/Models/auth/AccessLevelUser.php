<?php

namespace App\Models\auth;

use App\Models\auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLevelUser extends Model
{
    use HasFactory;

    protected $table = 'access_level_user';

    protected $fillable = [
        'id',
        'level_name',
        'description',
        'access_level_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'access_level_id');
    }
}
