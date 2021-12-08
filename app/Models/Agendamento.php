<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\Visitante;

class Agendamento extends Model
{
  use HasFactory;
  protected $fillable = ['status_agendamento','paciente_id', 'visitante_id', 'data_agendamento','hora_agendamento'];

  public function paciente(){
    return $this->belongsTo(Paciente::class);
  }

  public function visitante(){
    return $this->belongsTo(Visitante::class);
  }
}
