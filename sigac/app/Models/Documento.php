<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documentos';
    protected $fillable = ['url', 'descricao', 'horas_in', 'status', 'comentario', 'horas_out', 'categoria_id'];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
