<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Filial;

class TypeFilial extends Model
{
    use HasFactory;

    // Defina a tabela se o nome não seguir a convenção do Laravel
    protected $table = 'type_filial';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    // Defina a relação com a model Filial
    public function filials()
    {
        return $this->hasMany(Filial::class, 'type_filial_id');
    }
}