@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Detalhes do agendamento</h5>
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
            <td>{{$agendamento->id}}</td>
            <td>
              @if($agendamento->status_agendamento == 1)Solicitado

              @elseif($agendamento->status_agendamento == 2)Aprovado

              @elseif($agendamento->status_agendamento == 3)Negado

              @endif</td>
              <td>{{$agendamento->paciente->nome}}</td>
              <td>{{$agendamento->visitante->nome}}</td>
              <td>{{$agendamento->data_agendamento}}</td>
              <td>
                @if($agendamento->hora_agendamento == 1)08:00
                @elseif($agendamento->hora_agendamento == 2)09:00
                @elseif($agendamento->hora_agendamento == 3)10:00
                @elseif($agendamento->hora_agendamento == 4)14:00
                @elseif($agendamento->hora_agendamento == 5)15:00
                @elseif($agendamento->hora_agendamento == 6)16:00
                @elseif($agendamento->hora_agendamento == 7)17:00                
                @endif
              </td>

            </tr>

          </tbody>

        </table>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-2">
            <a class="btn btn-info" role="button" href="{{route('agendamentos.edit', $agendamento->id)}}">
              <i class="fa fa-list"></i> Editar
            </a>
          </div>

          <div class="col-2">
            <a class="btn btn-secondary" role="button" href="{{route('agendamentos.index')}}">
              <i class="fa fa-arrow-left"></i> Voltar
            </a>
          </div>

          <div class="col-2">
            <form  name="frmDelete"
            action="{{route('agendamentos.destroy', $agendamento->id)}}" method="post" onsubmit="return confirm('Deseja exlcuir?')">

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
