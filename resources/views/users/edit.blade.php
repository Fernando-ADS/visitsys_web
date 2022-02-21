@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Edição de usuários</h5>
    <hr class="m-b-5">
  </div>

  <div class="container-fluid">

    <form class="container-fluid " action="{{route('users.update', $user->id)}}" method="post">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-sm-6">
          <label for="nome" id="labelNome">Nome:</label>
          <input type="text" name="nome" id="nome" value="{{$user->name}}" class="form-control" required>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <label for="email" id="labelEmail">Email:</label>
          <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control" required>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <label for="tipo" id="labeltipo">Perfil:</label>
          <select name="tipo" id="tipo" class="form-control">
            <option value="" disabled selected>Selecione</option>

            <option value="admin"
            @if($user->tipo == 'admin')
            selected
            @endif
            >Admin</option>

            <option value="user"
            @if($user->tipo == 'user')
            selected
            @endif
            >User</option>
          </select>
        </div>

      </div>
      <br>

      <div>
        <button class="btn btn-info" type="submit" >
          <i class="fa fa-check" ></i> Atualizar
        </button>

        <a class="btn btn-secondary" role="button" href="{{route('users.index')}}">
          <i class="fa fa-arrow-left"></i> Voltar
        </a>
      </div>

    </div>
  </form>


</div>



@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->
