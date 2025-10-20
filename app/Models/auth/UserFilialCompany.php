<?php

namespace App\Models\Auth;

use App\Models\Auth\User;
use App\Models\Company\Filial;
use App\Models\Company\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFilialCompany extends Model
{
    use HasFactory;

    // Defina a tabela se o nome não seguir a convenção do Laravel
    protected $table = 'user_filial_company';

    protected $fillable = [
        'id',
        'user_id',
        'filial_id',
        'company_id',
    ];

    // Defina a relação com a model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Defina a relação com a model Filial
    public function filial()
    {
        return $this->belongsTo(Filial::class, 'filial_id');
    }

    // Defina a relação com a model Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
