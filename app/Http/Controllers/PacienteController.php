<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Agendamento;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;

class PacienteController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $pacientes = Paciente::orderBy('nome')->get();
    return view('pacientes.index', ['pacientes' => $pacientes]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('pacientes.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Http\Requests\StorePacienteRequest  $request
  * @return \Illuminate\Http\Response
  */
  public function store(StorePacienteRequest $request)
  {
    Paciente::create($request->all());
    //$request->session()->flash('mensagem', "sucesso");
    //session()->flash('mensagem', "Cadastrado com sucesso!");
    //toastr()->info('welcome admin!', 'err');
    //Toastr::success('Post added successfully :)','Success');
    return redirect()->route('pacientes.index')->with(['mensagem' => 'Adicionado com sucesso']);
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Models\Paciente  $paciente
  * @return \Illuminate\Http\Response
  */
  public function show(Paciente $paciente)
  {
    return view('pacientes.show', ['paciente' => $paciente]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Paciente  $paciente
  * @return \Illuminate\Http\Response
  */
  public function edit(Paciente $paciente)
  {
    return view('pacientes.edit', ['paciente' => $paciente]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \App\Http\Requests\UpdatePacienteRequest  $request
  * @param  \App\Models\Paciente  $paciente
  * @return \Illuminate\Http\Response
  */
  public function update(UpdatePacienteRequest $request, Paciente $paciente)
  {
    $paciente->fill($request->all());
    $paciente->save();

    //$request->session()->flash('mensagem', "Atualizado com sucesso!");


    session()->flash('mensagem', 'Atualizado com sucesso!');
    return redirect()->route('pacientes.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Paciente  $paciente
  * @return \Illuminate\Http\Response
  */
  public function destroy(Paciente $paciente)
  {
    if($paciente->visitas->count()>0 || $paciente->agendamentos->count()>0){
      session()->flash('mensagem', 'Não é permitido excluir! Existem associacões!');
    }

    else {
      $paciente->delete();
      session()->flash('mensagem', 'Excluído com sucesso!');
    }
    return redirect()->route('pacientes.index');
  }

  public function search()
  {
    $pesquisa = $_GET['search'];
    $pacientes = Paciente::where('nome','LIKE','%'.$pesquisa.'%')->get();

    return view('pacientes.search', compact('pacientes'));
  }

}
