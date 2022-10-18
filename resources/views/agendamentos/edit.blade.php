@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Edição de agendamentos</h5>
    <hr class="m-b-5">
  </div>


  <div class="container-fluid">
    <form class="container-fluid " action="{{route('agendamentos.update', $agendamento->id)}}" method="post">

      @csrf
      @method('PUT')

      @can('is_admin')
      <div>
        <label for="status_agendamento" id="labelstatus_agendamento">Status:</label>
        <select name="status_agendamento" id="status_agendamento" class="form-control">
          <option value="" disabled selected>Selecione</option>

          <option value="1" @if($agendamento->status_agendamento == '1')
            selected
            @endif
            >Solicitado</option>

          <option value="2" @if($agendamento->status_agendamento == '2')
            selected
            @endif
            >Aprovado</option>

          <option value="3" @if($agendamento->status_agendamento == '3')
            selected
            @endif
            >Negado</option>
        </select>
      </div>
      @endcan

      @can('is_user')
      <div>
        <label for="status_agendamento" id="labelstatus_agendamento">Status:</label>
        <select name="status_agendamento" id="status_agendamento" class="form-control" disabled>
          <option value="" disabled selected>Selecione</option>

          <option value="1" @if($agendamento->status_agendamento == '1')
            selected
            @endif
            >Solicitado</option>

          <option value="2" @if($agendamento->status_agendamento == '2')
            selected
            @endif
            >Aprovado</option>

          <option value="3" @if($agendamento->status_agendamento == '3')
            selected
            @endif
            >Negado</option>
        </select>
      </div>
      @endcan



      @can('is_admin')
      <div class="row">
        <div class="col-sm-6">
          <label for="paciente_id" id="labelpaciente_id">Paciente:</label>
          <select name="paciente_id" id="paciente_id" class="form-control">
            <option value="{{$agendamento->paciente->id}}">{{$agendamento->paciente->nome}}</option>
            @foreach($pacientes as $paciente)
            <option value="{{$paciente->id}}">{{$paciente->nome}}</option>
            @endforeach
          </select>
        </div>
        @endcan



        @can('is_user')
        <div class="row">
          <div class="col-sm-6">
            <label for="paciente_id" id="labelpaciente_id">Paciente:</label>
            <select name="paciente_id" id="paciente_id" class="form-control" disabled>
              <option value="{{$agendamento->paciente->id}}">{{$agendamento->paciente->nome}}</option>
              @foreach($pacientes as $paciente)
              <option value="{{$paciente->id}}">{{$paciente->nome}}</option>
              @endforeach
            </select>
          </div>
          @endcan



          @can('is_admin')
          <div class="col-sm-6">
            <label for="user_id" id="labeluser_id">Visitante:</label>
            <select name="user_id" id="user_id" class="form-control">
              <option value="{{$agendamento->user->id}}">{{$agendamento->user->name}}</option>
              @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        @endcan



        @can('is_user')
        <div class="col-sm-6">
          <label for="user_id" id="labeluser_id">Visitante:</label>
          <select name="user_id" id="user_id" class="form-control" disabled>
            <option value="{{$agendamento->user->id}}">{{$agendamento->user->name}}</option>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      @endcan



      <div class="row">
        <div class="col-sm-6">
          <label for="data_agendamento" id="labelData">Data:</label>
          <input type="date" name="data_agendamento" id="data_agendamento" value="{{$agendamento->data_agendamento}}" class="form-control" required>
        </div>



        <div class="col-sm-6">
          <label for="hora_agendamento" id="labelhora_agendamento">Horário:</label>
          <select name="hora_agendamento" id="hora_agendamento" class="form-control">
            <option value="" disabled selected>Selecione</option>

            <option value="1" @if($agendamento->hora_agendamento == '1')
              selected
              @endif
              >08:00</option>

            <option value="2" @if($agendamento->hora_agendamento == '2')
              selected
              @endif
              >09:00</option>

            <option value="3" @if($agendamento->hora_agendamento == '3')
              selected
              @endif
              >10:00</option>

            <option value="4" @if($agendamento->hora_agendamento == '4')
              selected
              @endif
              >14:00</option>

            <option value="5" @if($agendamento->hora_agendamento == '5')
              selected
              @endif
              >15:00</option>

            <option value="6" @if($agendamento->hora_agendamento == '6')
              selected
              @endif
              >16:00</option>

            <option value="7" @if($agendamento->hora_agendamento == '7')
              selected
              @endif
              >17:00</option>
          </select>
        </div>

        <!--
        <div class="col-sm-6">
        <label for="hora_agendamento" id="labelHora">Hora:</label>
        <input type="time" name="hora_agendamento" id="hora_agendamento" value="{{$agendamento->hora_agendamento}}" class="form-control" required>
      </div>
    -->
      </div>

      <br>
      
      <div class="btn-group">
        <div class="col-xs">
          <button class="btn btn-info" type="submit">
            <i class="fa fa-check"></i> Atualizar
          </button>
        </div>

    </form>
    <div class="col-md">
      <a class="btn btn-secondary" role="button" href="{{route('agendamentos.index')}}">
        <i class="fa fa-arrow-left"></i> Voltar
      </a>
    </div>

    <form name="frmDelete" action="{{route('agendamentos.destroy', $agendamento->id)}}" method="post" onsubmit="return confirm('Deseja excluir?')">

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