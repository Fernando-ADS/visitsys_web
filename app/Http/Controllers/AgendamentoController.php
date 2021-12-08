<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Coordenador;
use App\Models\Paciente;
use App\Models\Recepcionista;
use App\Models\Visitante;
use App\Http\Requests\StoreAgendamentoRequest;
use App\Http\Requests\UpdateAgendamentoRequest;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $agendamentos = Agendamento::orderBy('id')->get();
      return view('agendamentos.index', ['agendamentos' => $agendamentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $pacientes = Paciente::get();
      $visitantes = Visitante::get();
      $agendamentos = Agendamento::get();
      return view('agendamentos.create', ['pacientes'=>$pacientes, 'visitantes'=> $visitantes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgendamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgendamentoRequest $request)
    {
      Agendamento::create($request->all());
      session()->flash('mensagem', 'Cadastrado com sucesso!');
      return redirect()->route('agendamentos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show(Agendamento $agendamento)
    {
      return view('agendamentos.show', ['agendamento' => $agendamento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamento $agendamento)
    {
      $pacientes = Paciente::get();
      $visitantes = Visitante::get();
      return view('agendamentos.edit', ['pacientes'=>$pacientes, 'visitantes'=> $visitantes, 'agendamento'=>$agendamento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgendamentoRequest  $request
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgendamentoRequest $request, Agendamento $agendamento)
    {
      $agendamento->fill($request->all());
      $agendamento->save();

      session()->flash('mensagem', 'Atualizado com sucesso!');
      return redirect()->route('agendamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento)
    {
      {
        $agendamento->delete();
        session()->flash('mensagem', 'Excluído com sucesso!');
        return redirect()->route('agendamentos.index');
      }
    }

    public function search()
    {
      $pesquisa = $_GET['search'];
      $agendamentos = Agendamento::where('paciente_id','LIKE','%'.$pesquisa.'%')->get();

      return view('agendamentos.search', compact('agendamentos'));
    }

    
}
