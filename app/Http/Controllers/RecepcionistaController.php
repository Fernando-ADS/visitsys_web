<?php

namespace App\Http\Controllers;

use App\Models\Recepcionista;
use App\Http\Requests\StoreRecepcionistaRequest;
use App\Http\Requests\UpdateRecepcionistaRequest;
use App\Models\User;


class RecepcionistaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $recepcionistas = Recepcionista::orderBy('nome')->get();
    return view('recepcionistas.index', ['recepcionistas' => $recepcionistas]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('recepcionistas.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreRecepcionistaRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreRecepcionistaRequest $request)
  {
    Recepcionista::create($request->all());

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



    toast('Cadastrado com sucesso!','success');
    return redirect()->route('recepcionistas.index')->with(['mensagem' => 'Adicionado com sucesso']);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Recepcionista  $recepcionista
   * @return \Illuminate\Http\Response
   */
  public function show(Recepcionista $recepcionista)
  {
    return view('recepcionistas.show', ['recepcionista' => $recepcionista]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Recepcionista  $recepcionista
   * @return \Illuminate\Http\Response
   */
  public function edit(Recepcionista $recepcionista)
  {
    return view('recepcionistas.edit', ['recepcionista' => $recepcionista]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateRecepcionistaRequest  $request
   * @param  \App\Models\Recepcionista  $recepcionista
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRecepcionistaRequest $request, Recepcionista $recepcionista)
  {
    $recepcionista->fill($request->all());
    $recepcionista->save();

    toast('Atualizado com sucesso!','success');
    return redirect()->route('recepcionistas.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Recepcionista  $recepcionista
   * @return \Illuminate\Http\Response
   */
  public function destroy(Recepcionista $recepcionista)
  {
    $recepcionista->delete();
    toast('Excluído com sucesso!','success');
    return redirect()->route('recepcionistas.index');
  }

  public function search()
  {
    $pesquisa = $_GET['search'];
    $recepcionistas = Recepcionista::where('nome', 'LIKE', '%' . $pesquisa . '%')->get();

    return view('recepcionistas.search', compact('recepcionistas'));
  }
}
