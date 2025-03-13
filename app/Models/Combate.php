<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Hasfactory;
use Illuminate\Database\Eloquent\Model;

class Combate extends Model
{
    use HasFactory;

    protected $table = 'combates';

    protected $fillable = [
        'entrenador1_id',
        'entrenador2_id',
        'fecha',
        'resultado'
    ];

    public function entrenador1(){
        return $this->belongsTo(Entrenador::class, 'entrenador1_id');
    }
    public function entrenador2(){
        return $this->belongsTo(Entrenador::class, 'entrenador2_id');
    }
}
