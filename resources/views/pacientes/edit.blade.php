@extends('adminlte::page')
@section('content')

<div class="card">
    <div class="card-header">
        <i class="fa fa-info-circle"></i>
        <h5>Edição de pacientes</h5>
        <hr class="m-b-5">
    </div>

<div class="container-fluid">

  <form class="container-fluid " action="{{route('pacientes.update', $paciente->id)}}" method="post">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-sm-6">
      <label for="cpf" id="labelCnpj">CPF:</label>
      <input type=text name="cpf" id="cpf"
      value="{{$paciente->cpf}}" minlength="11" maxlength="11" onkeypress="if (!isNaN(String.fromCharCode(window.event.keyCode))) return true; else return false;" class="form-control" required>
    </div>

    <div class="col-sm-6">
      <label for="nome" id="labelNome">Nome:</label>
      <input type="text" name="nome" id="nome" value="{{$paciente->nome}}" class="form-control" required>
    </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
      <label for="telefone" id="labelTelefone">Telefone:</label>
      <input type="text" name="telefone" id="telefone" value="{{$paciente->telefone}}" minlength="8" maxlength="13"  onkeypress="if (!isNaN(String.fromCharCode(window.event.keyCode))) return true; else return false;" class="form-control" required>
    </div>

  <div class="col-sm-6">
      <label for="email" id="labelEmail">Email:</label>
      <input type="email" name="email" id="email" value="{{$paciente->email}}" class="form-control" required>
    </div>
    </div>

    <div class="form-group">
      <label for="endereco" id="labelEndereco">Endereço:</label>
      <input type="text" name="endereco" id="endereco" value="{{$paciente->endereco}}" class="form-control" required>


    <br>

    <div>
        <button class="btn btn-info" type="submit" >
            <i class="fa fa-check" ></i> Atualizar
        </button>

        <button class="btn btn-danger" type="reset" >
            <i class="fa fa-minus"></i> Limpar
        </button>
    </div>

</div>
  </form>
</div>



@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->
