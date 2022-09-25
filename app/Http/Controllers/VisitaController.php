<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\Coordenador;
use App\Models\Paciente;
use App\Models\Recepcionista;
use App\Models\Visitante;
use App\Models\User;
use App\Http\Requests\StoreVisitaRequest;
use App\Http\Requests\UpdateVisitaRequest;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $visitas = Visita::orderBy('id')->get();
      return view('visitas.index', ['visitas' => $visitas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $pacientes = Paciente::get();
      $users = User::get();
      $visitas = Visita::get();
      return view('visitas.create', ['pacientes'=>$pacientes, 'users'=> $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVisitaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisitaRequest $request)
    {
      Visita::create($request->all());
      session()->flash('mensagem', 'Cadastrado com sucesso!');
      return redirect()->route('visitas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function show(Visita $visita)
    {
      return view('visitas.show', ['visita' => $visita]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function edit(Visita $visita)
    {
      $pacientes = Paciente::get();
      $users = User::get();
      return view('visitas.edit', ['pacientes'=>$pacientes, 'users'=> $users, 'visita'=>$visita]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVisitaRequest  $request
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVisitaRequest $request, Visita $visita)
    {
      $visita->fill($request->all());
      $visita->save();

      session()->flash('mensagem', 'Atualizado com sucesso!');
      return redirect()->route('visitas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visita $visita)
    {
      {
        $visita->delete();
        session()->flash('mensagem', 'Excluído com sucesso!');
        return redirect()->route('visitas.index');
      }
    }

    public function search()
    {
      $pesquisa = $_GET['search'];
      $visitas = Visita::where('paciente_id','LIKE','%'.$pesquisa.'%')->get();

      return view('visitas.search', compact('visitas'));
    }
}
