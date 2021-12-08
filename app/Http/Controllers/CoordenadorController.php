<?php

namespace App\Http\Controllers;

use App\Models\Coordenador;
use App\Http\Requests\StoreCoordenadorRequest;
use App\Http\Requests\UpdateCoordenadorRequest;

class CoordenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $coordenadors = Coordenador::orderBy('nome')->get();
      return view('coordenadors.index', ['coordenadors' => $coordenadors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('coordenadors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCoordenadorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoordenadorRequest $request)
    {
      Coordenador::create($request->all());
      //$request->session()->flash('mensagem', "sucesso");
      //session()->flash('mensagem', "Cadastrado com sucesso!");
      //toastr()->info('welcome admin!', 'err');
      //Toastr::success('Post added successfully :)','Success');
      return redirect()->route('coordenadors.index')->with(['mensagem' => 'Adicionado com sucesso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coordenador  $coordenador
     * @return \Illuminate\Http\Response
     */
    public function show(Coordenador $coordenador)
    {
    return view('coordenadors.show', ['coordenador' => $coordenador]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coordenador  $coordenador
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordenador $coordenador)
    {
    return view('coordenadors.edit', ['coordenador' => $coordenador]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoordenadorRequest  $request
     * @param  \App\Models\Coordenador  $coordenador
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoordenadorRequest $request, Coordenador $coordenador)
    {
      $coordenador->fill($request->all());
      $coordenador->save();

      //$request->session()->flash('mensagem', "Atualizado com sucesso!");


      session()->flash('mensagem', 'Atualizado com sucesso!');
      return redirect()->route('coordenadors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coordenador  $coordenador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordenador $coordenador)
    {
      $coordenador->delete();
      session()->flash('mensagem', 'Excluído com sucesso!');
      return redirect()->route('coordenadors.index');
    }

    public function search()
    {
      $pesquisa = $_GET['search'];
      $coordenadors = Coordenador::where('nome','LIKE','%'.$pesquisa.'%')->get();

      return view('coordenadors.search', compact('coordenadors'));
    }
}
