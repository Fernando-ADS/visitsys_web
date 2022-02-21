<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Agendamento;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $this->authorize('is_admin');
    $users = User::orderBy('name')->get();
    return view('users.index', ['users' => $users]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
        $this->authorize('is_admin');
  //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Http\Requests\StoreUserRequest  $request
  * @return \Illuminate\Http\Response
  */
  public function store(StoreUserRequest $request)
  {
        $this->authorize('is_admin');
  //
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Models\User  $user
  * @return \Illuminate\Http\Response
  */
  public function show(User $user)
  {
        $this->authorize('is_admin');
    return view('users.show', ['user' => $user]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\User  $user
  * @return \Illuminate\Http\Response
  */
  public function edit(User $user)
  {
        $this->authorize('is_admin');
    return view('users.edit', ['user' => $user]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \App\Http\Requests\UpdateUserRequest  $request
  * @param  \App\Models\User  $user
  * @return \Illuminate\Http\Response
  */
  public function update(UpdateUserRequest $request, User $user)
  {
        $this->authorize('is_admin');
    $user->fill($request->all());
    $user->save();

    //$request->session()->flash('mensagem', "Atualizado com sucesso!");


    session()->flash('mensagem', 'Atualizado com sucesso!');
    return redirect()->route('users.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\User  $user
  * @return \Illuminate\Http\Response
  */
  public function destroy(User $user)
  {
        $this->authorize('is_admin');
    /*
    if($user->visitas->count()>0 || $user->agendamentos->count()>0){
      session()->flash('mensagem', 'Não é permitido excluir! Existem associacões!');
    }

    else {
      $user->delete();
      session()->flash('mensagem', 'Excluído com sucesso!');
    }
    return redirect()->route('users.index');
    */
  }

  public function search()
  {
        $this->authorize('is_admin');
    $pesquisa = $_GET['search'];
    $users = user::where('name','LIKE','%'.$pesquisa.'%')->get();

    return view('users.search', compact('users'));
  }

}
