@extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Edição de visitas</h5>
    <hr class="m-b-5">
  </div>


  <div class="container-fluid">
    <form class="container-fluid " action="{{route('visitas.update', $visita->id)}}" method="post">

      @csrf
      @method('PUT')

      <div>
        <label for="status_visita" id="labelstatus_visita">Status:</label>
        <select name="status_visita" id="status_visita" class="form-control">
          <option value="" disabled selected>Selecione</option>

          <option value="1" @if($visita->status_visita == '1')
            selected
            @endif
            >Solicitado</option>

          <option value="2" @if($visita->status_visita == '2')
            selected
            @endif
            >Aprovado</option>

          <option value="3" @if($visita->status_visita == '3')
            selected
            @endif
            >Negado</option>


            <option value="4" @if($visita->status_visita == '4')
            selected
            @endif
            >Realizado</option>

            <option value="5" @if($visita->status_visita == '5')
            selected
            @endif
            >Não Realizado</option>

        </select>
      </div>


      <div class="row">
        <div class="col-sm-12">
          <label for="paciente_id" id="labelpaciente_id">Paciente:</label>
          <select name="paciente_id" id="paciente_id" class="form-control">
            <option value="{{$visita->paciente->id}}">{{$visita->paciente->nome}}</option>
            @foreach($pacientes as $paciente)
            <option value="{{$paciente->id}}">{{$paciente->nome}}</option>
            @endforeach
          </select>
        </div>


        <div class="col-sm-6">
          <label for="user_id" id="labeluser_id">Visitante:</label>
          <select name="user_id" id="user_id" class="form-control">
            <option value="{{$visita->user->id}}">{{$visita->user->name}}</option>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="col-sm-6">
          <label for="parentesco" id="labelParentesco">Parentesco:</label>
          <input type="text" name="parentesco" id="parentesco" value="{{$visita->parentesco}}" class="form-control">
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
          <label for="data_visita" id="labelData">Data:</label>
          <input type="date" name="data_visita" id="data_visita" value="{{$visita->data_visita}}" class="form-control" required>
        </div>



        <div class="col-sm-6">
          <label for="hora_visita" id="labelhora_visita">Horário:</label>
          <select name="hora_visita" id="hora_visita" class="form-control">
            <option value="" disabled selected>Selecione</option>

            <option value="1" @if($visita->hora_visita == '1')
              selected
              @endif
              >08:00</option>

            <option value="2" @if($visita->hora_visita == '2')
              selected
              @endif
              >09:00</option>

            <option value="3" @if($visita->hora_visita == '3')
              selected
              @endif
              >10:00</option>

            <option value="4" @if($visita->hora_visita == '4')
              selected
              @endif
              >14:00</option>

            <option value="5" @if($visita->hora_visita == '5')
              selected
              @endif
              >15:00</option>

            <option value="6" @if($visita->hora_visita == '6')
              selected
              @endif
              >16:00</option>

            <option value="7" @if($visita->hora_visita == '7')
              selected
              @endif
              >17:00</option>
          </select>
        </div>








        <!--
        <div class="col-sm-6">
          <label for="hora_visita" id="labelHora">Hora:</label>
          <input type="time" name="hora_visita" id="hora_visita" value="{{$visita->hora_visita}}" class="form-control" required>
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
      <a class="btn btn-secondary" role="button" href="{{route('visitas.index')}}">
        <i class="fa fa-arrow-left"></i> Voltar
      </a>
    </div>

    <form name="frmDelete" action="{{route('visitas.destroy', $visita->id)}}" method="post" onsubmit="return confirm('Deseja excluir?')">

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