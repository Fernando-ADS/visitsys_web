@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Edição de Visitantes</h5>
    <hr class="m-b-5">
  </div>

  <div class="container-fluid">

    <form class="container-fluid " action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')


      <br>

      <div>
        <img class="profile-user-img img-fluid img-circle" src="../../../fotosUsuarios/{{$user->foto}}" alt="User profile picture">
      </div>

      <div>
        <br>
        <input type="file" name="foto" id="foto" class="form-control-file">
      </div>

      <br>


      <div class="row">
        <div class="col-sm-6">
          <label for="name" id="labelName">Nome:</label>
          <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" required>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <label for="email" id="labelEmail">Email:</label>
          <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control" required>
        </div>
      </div>


      <!--
      <div class="row">
        <div class="col-sm-6">
          <label for="cpf" id="labelcpf">CPF:</label>
          <input type="cpf" name="cpf" id="cpf" value="{{$user->cpf}}" class="form-control" required>
        </div>
      </div>
      -->

      <div class="row">
        <div class="col-sm-6">
          <label for="tipo" id="labeltipo">Perfil:</label>
          <select name="tipo" id="tipo" class="form-control">
            <option value="" disabled selected>Selecione</option>

            <option value="admin" @if($user->tipo == 'admin')
              selected
              @endif
              >Admin</option>

            <option value="user" @if($user->tipo == 'user')
              selected
              @endif
              >User</option>
          </select>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
          <label for="telefone" id="labeltelefone">Telefone:</label>
          <input type="telefone" name="telefone" id="telefone" value="{{$user->telefone}}" class="form-control" required>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
          <label for="endereco" id="labelendereco">Endereço:</label>
          <input type="endereco" name="endereco" id="endereco" value="{{$user->endereco}}" class="form-control" required>
        </div>
      </div>

      <br>

      <div>
        <div class="btn-group">

          <div class="col-xs">
            <button class="btn btn-info" type="submit">
              <i class="fa fa-check"></i> Atualizar
            </button>
          </div>

          <div class="col-md">
            <a class="btn btn-secondary" role="button" href="{{route('users.index')}}">
              <i class="fa fa-arrow-left"></i> Voltar
            </a>
          </div>

    </form>

    <form name="frmDelete" action="{{route('users.destroy', $user->id)}}" method="post" onsubmit="return confirm('Deseja excluir?')">

      @csrf
      @method('DELETE')

      <div>
        <button class="btn btn-danger" type="submit">
          <i class="fa fa-trash"></i> Excluir
        </button>
      </div>
  </div>
  </form>
</div>
<br>
</div>
</div>


@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->