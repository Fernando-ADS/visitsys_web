<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Agendamento;
use App\Http\Requests\StoreVisitanteRequest;
use App\Http\Requests\UpdateVisitanteRequest;

class VisitanteController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $visitantes = Visitante::orderBy('nome')->get();
    return view('visitantes.index', ['visitantes' => $visitantes]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('visitantes.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Http\Requests\StoreVisitanteRequest  $request
  * @return \Illuminate\Http\Response
  */
  public function store(StoreVisitanteRequest $request)
  {
    Visitante::create($request->all());
    session()->flash('mensagem', 'Cadastrado com sucesso!');
    return redirect()->route('visitantes.index');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Models\Visitante  $visitante
  * @return \Illuminate\Http\Response
  */
  public function show(Visitante $visitante)
  {
    return view('visitantes.show', ['visitante' => $visitante]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Visitante  $visitante
  * @return \Illuminate\Http\Response
  */
  public function edit(Visitante $visitante)
  {
    return view('visitantes.edit', ['visitante' => $visitante]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \App\Http\Requests\UpdateVisitanteRequest  $request
  * @param  \App\Models\Visitante  $visitante
  * @return \Illuminate\Http\Response
  */
  public function update(UpdateVisitanteRequest $request, Visitante $visitante)
  {
    $visitante->fill($request->all());
    $visitante->save();

    session()->flash('mensagem', 'Atualizado com sucesso!');
    return redirect()->route('visitantes.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Visitante  $visitante
  * @return \Illuminate\Http\Response
  */
  public function destroy(Visitante $visitante)
  {
    if($visitante->visitas->count()>0 || $visitante->agendamentos->count()>0){
      session()->flash('mensagem', 'Não é permitido excluir! Existem associacões!');
    }

    else {
      $visitante->delete();
      session()->flash('mensagem', 'Excluído com sucesso!');
    }
    return redirect()->route('visitantes.index');
  }


public function search()
{
  $pesquisa = $_GET['search'];
  $visitantes = Visitante::where('nome','LIKE','%'.$pesquisa.'%')->get();

  return view('visitantes.search', compact('visitantes'));
}
}
