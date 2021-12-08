<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Visita;
use App\Models\Agendamento;

class Paciente extends Model
{
  use HasFactory;
  protected $fillable = ['cpf', 'nome', 'telefone','email','endereco'];

  public function agendamentos(){
    return $this->hasMany(Agendamento::class);
  }

  public function visitas(){
    return $this->hasMany(Visita::class);
  }
}
