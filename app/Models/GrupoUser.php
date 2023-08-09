<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoUser extends Model
{
    use HasFactory;

    protected $table = 'grupos_users';

    protected $fillable = ['user_id', 'grupo_id', 'admin','status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
}
