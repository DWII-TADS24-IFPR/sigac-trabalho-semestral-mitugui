<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nivel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nivels';
    protected $fillable = ['nome'];

    public function cursos() {
        return $this->hasMany(Curso::class);
    }
}
