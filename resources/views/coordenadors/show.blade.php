@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Detalhes do coordenadores</h5>
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
            <th>Telefone</th>
            <th>Email</th>
            <th>Endereço</th>
          </tr>
        </thead>


        <tbody class="tbody">
          <tr>
            <td>{{$coordenador->cpf}}</td>
            <td>{{$coordenador->nome}}</td>
            <td>{{$coordenador->telefone}}</td>
            <td>{{$coordenador->email}}</td>
            <td>{{$coordenador->endereco}}</td>
          </tr>

        </tbody>

      </table>
    </div>



    <div>
      <a class="btn btn-info" role="button" href="{{route('coordenadors.edit', $coordenador->id)}}">
        <i class="fa fa-list"></i> Editar
      </a>

      <a class="btn btn-secondary" role="button" href="{{route('coordenadors.index')}}">
        <i class="fa fa-arrow-left"></i> Voltar
      </a>
    </div>


    <br>
    <div>
      <form  name="frmDelete"
      action="{{route('coordenadors.destroy', $coordenador->id)}}" method="post" onsubmit="return confirm('Deseja excluir?')">

      @csrf
      @method('DELETE')

      <button class="btn btn-danger" type="submit" >
        <i class="fa fa-trash"></i> Excluir
      </button>

    </form>

  </div>
</div>
</div>
</div>
</div>

@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->
