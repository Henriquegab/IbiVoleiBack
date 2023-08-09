<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'dias_solicitacoes', 'user_id', 'grupo_id');
    }
}
