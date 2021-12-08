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
        <input type="text" name="cpf" id="cpf" value="" class="form-control" minlength="11" maxlength="11"  onkeypress="if (!isNaN(String.fromCharCode(window.event.keyCode))) return true; else return false;" required>
      </div>

    <div class="col-sm-6">
      <label for="nome" id="labelNome">Nome:</label>
      <input type="text" name="nome" id="nome" value="" class="form-control" required>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <label for="telefone" id="labelTelefone">Telefone:</label>
      <input type="text" name="telefone" id="telefone" value="" minlength="8" maxlength="11"  onkeypress="if (!isNaN(String.fromCharCode(window.event.keyCode))) return true; else return false;"  class="form-control" required>
    </div>

    <div class="col-sm-6">
      <label for="email" id="labelEmail">Email:</label>
      <input type="email" name="email" id="email" value="" class="form-control" required>
    </div>
  </div>

    <div class="form-group">
      <label for="endereco" id="labelEndereco">Endereço:</label>
      <input type="text" name="endereco" id="endereco" value="" class="form-control" required>

    <br>

    <div>
        <button class="btn btn-info" type="submit">
            <i class="fa fa-plus"></i> Inserir
        </button>

        <button class="btn btn-danger" type="reset" >
            <i class="fa fa-minus"></i> Limpar
        </button>
    </div>

    @if (session()->has('mensagem'))
      <script>
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: "Your work has been saved",
          showConfirmButton: false,
          timer: 1500
        })
      </script>
    @endif

    </div>

  </form>
</div>

@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->
