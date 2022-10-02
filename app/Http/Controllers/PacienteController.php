<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Agendamento;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
//use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;
use Symfony\Component\HttpFoundation\Session\Session;
use TJGazel\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;



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
    toast('Cadastrado com sucesso!','success');
    return redirect()->route('pacientes.index');
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

    toast('Atualizado com sucesso!','success');
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
      toast('Não é permitido remover esse paciente!','error');
    }

    else {
      $paciente->delete();
      toast('Excluído com sucesso!','success');
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
