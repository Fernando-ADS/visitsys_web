@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Detalhes do pacientes</h5>
    <hr class="m-b-5">
  </div>

  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" style="text-align:center">
        <br>
        <thead class="thead">
          <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Ala</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Endereço</th>
          </tr>
        </thead>


        <tbody class="tbody">
          <tr>
            <td>{{$paciente->cpf}}</td>
            <td>{{$paciente->nome}}</td>
            <td>
              @if($paciente->ala == 1)A
              @elseif($paciente->ala == 2)B
              @elseif($paciente->ala == 3)C
              @elseif($paciente->ala == 4)D
              @elseif($paciente->ala == 5)E
              @elseif($paciente->ala == 6)F
              @endif
            </td>
            <td>{{$paciente->telefone}}</td>
            <td>{{$paciente->email}}</td>
            <td>{{$paciente->endereco}}</td>
          </tr>

        </tbody>

      </table>
    </div>


    <div class="container-fluid">
      <div class="btn-group">
        <div class="col-xs">
          <a class="btn btn-info" role="button" href="{{route('pacientes.edit', $paciente->id)}}">
            <i class="fa fa-list"></i> Editar
          </a>
        </div>


        <div class="col-md">
          <a class="btn btn-secondary" role="button" href="{{route('pacientes.index')}}">
            <i class="fa fa-arrow-left"></i> Voltar
          </a>
        </div>

        <form name="frmDelete" action="{{route('pacientes.destroy', $paciente->id)}}" method="post" onsubmit="return confirm('Deseja excluir?')">

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
  </div>
  <br>
</div>
</div>
@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->