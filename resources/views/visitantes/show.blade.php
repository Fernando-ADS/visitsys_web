@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Detalhes do visitante</h5>
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
            <td>{{$visitante->cpf}}</td>
            <td>{{$visitante->nome}}</td>
            <td>{{$visitante->telefone}}</td>
            <td>{{$visitante->email}}</td>
            <td>{{$visitante->endereco}}</td>
          </tr>

        </tbody>

      </table>
    </div>



    <div>
      <a class="btn btn-info" role="button" href="{{route('visitantes.edit', $visitante->id)}}">
        <i class="fa fa-list"></i> Editar
      </a>

      <a class="btn btn-secondary" role="button" href="{{route('visitantes.index')}}">
        <i class="fa fa-arrow-left"></i> Voltar
      </a>
    </div>


    <br>
    <div>
      <form  name="frmDelete"
      action="{{route('visitantes.destroy', $visitante->id)}}" method="post" onsubmit="return confirm('Deseja excluir?')">

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
