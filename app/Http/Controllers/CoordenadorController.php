<?php

namespace App\Http\Controllers;

use App\Models\Coordenador;
use App\Http\Requests\StoreCoordenadorRequest;
use App\Http\Requests\UpdateCoordenadorRequest;
use App\Models\User;


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

    //Model User
    $name = $request->input('nome');
    $email = $request->input('email');
    $password = $request->input('email');

    $tipo = 'admin';

    $cpf = $request->input('cpf');
    $telefone = $request->input('telefone');
    $endereco = $request->input('endereco');

    $novo_user = new User();
    $novo_user->fill(array('name' => $name, 'email' => $email, 'password' => $password, 'tipo' => $tipo, 'cpf' => $cpf, 'telefone' => $telefone, 'endereco' => $endereco));
    $novo_user->save();


    toast('Cadastrado com sucesso!', 'success');
    return redirect()->route('coordenadors.index');
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
    toast('Atualizado com sucesso!', 'success');
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
    toast('Excluído com sucesso!', 'success');
    return redirect()->route('coordenadors.index');
  }

  public function search()
  {
    $pesquisa = $_GET['search'];
    $coordenadors = Coordenador::where('nome', 'LIKE', '%' . $pesquisa . '%')->get();

    return view('coordenadors.search', compact('coordenadors'));
  }
}
