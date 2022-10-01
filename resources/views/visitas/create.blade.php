  @extends('adminlte::page')
@section('content')

<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Cadastro de visitas</h5>
    <hr class="m-b-5">
  </div>


  <div class="container-fluid">
    <form class="container-fluid " action="{{route('visitas.store')}}" method="post">

      @csrf

      <!--
      <div>
      <label for="status_visita" id="labelstatus_visita">Status:</label>
      <select name="status_visita" id="status_visita" class="form-control">
      <option value="1">Solicitado</option>
    </select>
  </div>
-->

<div>
  <label for="status_visita" id="labelstatus_visita">Status:</label>

  <div class="row">
    <div class="col-2">
      <input type="radio" name="status_visita" value="1" id="solicitado" checked>
      <label for="solicitado">Solicitado</label>
    </div>

    <div class="col-2">
      <input type="radio" name="status_visita" value="2" id="aprovado">
      <label for="aprovado">Aprovado</label>
    </div>

    <div class="col-2">
      <input type="radio" name="status_visita" value="3" id="negado">
      <label for="negado">Negado</label>
    </div>

  </div>

</div>



<div class="row">
  <div class="col-sm-6">
    <label for="paciente_id" id="labelpaciente_id">Paciente:</label>
    <select name="paciente_id" id="paciente_id" class="form-control">

      @foreach($pacientes as $e)
      <option value="{{$e->id}}">{{$e->nome}}</option>
      @endforeach
    </select>
  </div>


  <div class="col-sm-6">
    <label for="user_id" id="labeluser_id">User:</label>
    <select name="user_id" id="user_id" class="form-control">

      @foreach($users as $e)
      <option value="{{$e->id}}">{{$e->name}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <label for="data_visita" id="labelData">Data:</label>
    <input type="date" name="data_visita" id="data_visita" value="" class="form-control" required>
  </div>

  <!--
  <div class="col-sm-6">
    <label for="hora_visita" id="labelHora">Horário:</label>
    <input type="time" name="hora_visita" id="hora_visita" value="" class="form-control" required>
  </div>
-->

<div class="col-sm-6">
  <label for="hora_visita" id="labelhora_visita">Horário:</label>
  <select name="hora_visita" id="hora_visita" class="form-control" required>
    <option value="1">08:00</option>
    <option value="2">09:00</option>
    <option value="3">10:00</option>
    <option value="4">14:00</option>
    <option value="5">15:00</option>
    <option value="6">16:00</option>
    <option value="7">17:00</option>
  </select>
 </div>

</div>
<br>


<div class="form-group">
  <div>
    <button class="btn btn-info" type="submit">
      <i class="fa fa-plus"></i> Inserir
    </button>

    <button class="btn btn-danger" type="reset" >
      <i class="fa fa-minus"></i> Limpar
    </button>
  </div>
</div>

</form>
</div>

@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->
