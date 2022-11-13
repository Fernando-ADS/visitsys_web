<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\Visitante;
use App\Models\User;

class Visita extends Model
{
  use HasFactory;
  protected $fillable = ['status_visita','paciente_id', 'user_id', 'data_visita','hora_visita','parentesco'];

  public function paciente(){
    return $this->belongsTo(Paciente::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }

}
