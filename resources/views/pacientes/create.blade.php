@extends('adminlte::page')
@section('content')


<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Cadastro de pacientes</h5>
    <hr class="m-b-5">
  </div>


  <div class="container-fluid">
    <form class="container-fluid " action="{{route('pacientes.store')}}" method="post">

      @csrf

      <div class="row">
        <div class="col-sm-6">
          <label for="cpf" id="labelCpf">CPF:</label>
          <input type="text" name="cpf" id="cpf" value="" class="form-control" minlength="11" maxlength="11" onkeypress="if (!isNaN(String.fromCharCode(window.event.keyCode))) return true; else return false;" required>
        </div>

        <div class="col-sm-6">
          <label for="nome" id="labelNome">Nome:</label>
          <input type="text" name="nome" id="nome" value="" class="form-control" required>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <label for="telefone" id="labelTelefone">Telefone:</label>
          <input type="text" name="telefone" id="telefone" value="" minlength="8" maxlength="11" onkeypress="if (!isNaN(String.fromCharCode(window.event.keyCode))) return true; else return false;" class="form-control" required>
        </div>

        <div class="col-sm-6">
          <label for="email" id="labelEmail">Email:</label>
          <input type="email" name="email" id="email" value="" class="form-control" required>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-12">
          <label for="endereco" id="labelEndereco">Endereço:</label>
          <input type="text" name="endereco" id="endereco" value="" class="form-control" required>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
          <label for="ala" id="labelAla">Ala:</label>
          <select name="ala" id="ala" class="form-control" required>
            <option value="" disabled selected>Selecione</option>
            <option value="1">A</option>
            <option value="2">B</option>
            <option value="3">C</option>
            <option value="4">D</option>
            <option value="5">E</option>
            <option value="6">F</option>
          </select>
        </div>



        <div class="col-sm-6">
          <label for="quarto" id="labelQuarto">Quarto:</label>
          <select name="quarto" id="quarto" class="form-control" required>
            <option value="" disabled selected>Selecione</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
          </select>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-12">
          <label for="observacoes" id="labelObservacoes">Observações:</label>
          <input type="text" name="observacoes" id="observacoes" value="" class="form-control">
        </div>
      </div>


      <br>

      <div>
        <button class="btn btn-info" type="submit">
          <i class="fa fa-plus"></i> Inserir
        </button>

        <button class="btn btn-danger" type="reset">
          <i class="fa fa-minus"></i> Limpar
        </button>
      </div>
      <br>
  </div>

  </form>
</div>

@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->