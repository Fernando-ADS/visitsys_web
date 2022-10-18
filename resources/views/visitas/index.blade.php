@extends('adminlte::page')
@section('content')


<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class="page-header-title">
          <h5 class="m-b-10">
            <a href="{{ route('visitas.index') }}">
            </a>
          </h5>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h4>Listagem de Visitas</h4>
  </div>

  <div class="card-body">
    <div class="row">

      <!--
      <div class="col-md-6">
        <form method="GET" action="{{ route('visitas.search') }}">
          @csrf
          <div class="input-group mb-3">
            <input class="form-control" name="search"  placeholder="Informe o nome do paciente"/>
            <div class="input-group-append">
              <button class="btn btn-info" type="submit" >
                <i class="fa fa-search"></i> Buscar
              </button>
            </div>
          </div>
        </form>
      </div>
    -->


      <div class="col-md-12 text-right">
        <a href="{{ route('visitas.create') }}" class="btn btn-info">
          <i class="fa fa-plus"></i> Cadastrar
        </a>
      </div>

      <br>
      <br>


      <div class="col-md-12 table-responsive">
        <table class="table table-hover" style="text-align: center">
          <thead class="thead">
            <tr>
              <th>Status</th>
              <th>Paciente</th>
              <th>Visitante</th>
              <th>Data</th>
              <th>Hora</th>
              <th>Editar</th>
            </tr>
          </thead>


          <tbody class="tbody">

            @foreach($visitas as $e)
            <tr>

              <td>
                @if($e->status_visita == 1)Solicitado

                @elseif($e->status_visita == 2)Aprovado

                @elseif($e->status_visita == 3)Negado

                @endif</td>

              <td>{{$e->paciente->nome}}</td>
              <td>{{$e->user->name}}</td>

              <td>{{date('d/m/Y', strtotime($e->data_visita))}}</td>
              <td>
              @if($e->hora_visita == 1)08:00
              @elseif($e->hora_visita == 2)09:00
              @elseif($e->hora_visita == 3)10:00
              @elseif($e->hora_visita == 4)14:00
              @elseif($e->hora_visita == 5)15:00
              @elseif($e->hora_visita == 6)16:00
              @elseif($e->hora_visita == 7)17:00
              @endif
            </td>

              <td>
                <a href="{{route('visitas.edit', $e->id)}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#14a4bc" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                  </svg>
                </a>
              </td>
            </tr>

            @endforeach
          </tbody>

        </table>

      </div>


      @endsection
      <!--
    Fernando Aparecido da Silva - 1518291
  -->