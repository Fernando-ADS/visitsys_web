@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Detalhes do usuários</h5>
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
            <td>{{$user->email}}</td>
            </tr>

        </tbody>

      </table>
    </div>


    <div class="container-fluid">
      <div class="row">
        <div class="col-2">
          <a class="btn btn-info" role="button" href="{{route('users.edit', $user->name)}}">
            <i class="fa fa-list"></i> Editar
          </a>

        </div>
        <div class="col-2">
          <a class="btn btn-secondary" role="button" href="{{route('users.index')}}">
            <i class="fa fa-arrow-left"></i> Voltar
          </a>

        </div>

        <div class="col-2">
          <form name="frmDelete"
          action="{{route('users.destroy', $user->nome)}}" method="post" onsubmit="return confirm('Deseja excluir?')">

          @csrf
          @method('DELETE')

          <div>
            <button class="btn btn-danger" type="submit" >
              <i class="fa fa-trash"></i> Excluir
            </button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>
</div>
@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->
