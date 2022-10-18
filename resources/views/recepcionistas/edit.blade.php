@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Edição de recepcionistas</h5>
    <hr class="m-b-5">
  </div>

  <div class="container-fluid">

    <form class="container-fluid " action="{{route('recepcionistas.update', $recepcionista->id)}}" method="post">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-sm-6">
          <label for="cpf" id="labelCnpj">CPF:</label>
          <input type=text name="cpf" id="cpf" value="{{$recepcionista->cpf}}" minlength="11" maxlength="11" onkeypress="if (!isNaN(String.fromCharCode(window.event.keyCode))) return true; else return false;" class="form-control" required>
        </div>

        <div class="col-sm-6">
          <label for="nome" id="labelNome">Nome:</label>
          <input type="text" name="nome" id="nome" value="{{$recepcionista->nome}}" class="form-control" required>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
          <label for="telefone" id="labelTelefone">Telefone:</label>
          <input type="text" name="telefone" id="telefone" value="{{$recepcionista->telefone}}" minlength="8" maxlength="13" onkeypress="if (!isNaN(String.fromCharCode(window.event.keyCode))) return true; else return false;" class="form-control" required>
        </div>

        <div class="col-sm-6">
          <label for="email" id="labelEmail">Email:</label>
          <input type="email" name="email" id="email" value="{{$recepcionista->email}}" class="form-control" required>
        </div>
      </div>

      <div class="form-group">
        <label for="endereco" id="labelEndereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" value="{{$recepcionista->endereco}}" class="form-control" required>


        <br>

        <div class="btn-group">
        <div class="col-xs">
          <button class="btn btn-info" type="submit">
            <i class="fa fa-check"></i> Atualizar
          </button>
        </div>

    </form>
    <div class="col-md">
      <a class="btn btn-secondary" role="button" href="{{route('recepcionistas.index')}}">
        <i class="fa fa-arrow-left"></i> Voltar
      </a>
    </div>

    <form name="frmDelete" action="{{route('recepcionistas.destroy', $recepcionista->id)}}" method="post" onsubmit="return confirm('Deseja excluir?')">

      @csrf
      @method('DELETE')

      <div>
        <button class="btn btn-danger" type="submit">
          <i class="fa fa-trash"></i> Excluir
        </button>
      </div>

  </div>

</div>
<br>
</div>
</form>
</div>



@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->