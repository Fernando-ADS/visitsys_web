@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Detalhes do visita</h5>
    <hr class="m-b-5">
  </div>

  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" style="text-align:center">
        <br>
        <thead class="thead" >
          <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Paciente</th>
            <th>Visitante</th>
            <th>Data</th>
            <th>Hora</th>

          </tr>
        </thead>


        <tbody class="tbody">
          <tr>
            <td>{{$visita->id}}</td>
            <td>
              @if($visita->status_visita == 1)Solicitado

              @elseif($visita->status_visita == 2)Aprovado

              @elseif($visita->status_visita == 3)Negado

              @endif</td>
              <td>{{$visita->paciente->nome}}</td>
              <td>{{$visita->user->name}}</td>
              <td>{{$visita->data_visita}}</td>
              <td>
                @if($visita->hora_visita == 1)08:00
                @elseif($visita->hora_visita == 2)09:00
                @elseif($visita->hora_visita == 3)10:00
                @elseif($visita->hora_visita == 4)14:00
                @elseif($visita->hora_visita == 5)15:00
                @elseif($visita->hora_visita == 6)16:00
                @elseif($visita->hora_visita == 7)17:00
                @endif
              </td>

            </tr>

          </tbody>

        </table>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-2">
            <a class="btn btn-info" role="button" href="{{route('visitas.edit', $visita->id)}}">
              <i class="fa fa-list"></i> Editar
            </a>
          </div>

          <div class="col-2">
            <a class="btn btn-secondary" role="button" href="{{route('visitas.index')}}">
              <i class="fa fa-arrow-left"></i> Voltar
            </a>
          </div>

          <div class="col-2">
            <form  name="frmDelete"
            action="{{route('visitas.destroy', $visita->id)}}" method="post" onsubmit="return confirm('Deseja exlcuir?')">

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
