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
    <h4>Listagem de visitas</h4>
  </div>

  <div class="card-body">
    <div class="row">

      <div class="col-md-6">
        <form method="GET" action="{{ route('visitas.search') }}">
          @csrf
          <div class="input-group mb-3">
            <input class="form-control" name="search"  placeholder="Pesquisar"/>
            <div class="input-group-append">
              <button class="btn btn-info" type="submit" >
                <i class="fa fa-search"></i> Buscar
              </button>
            </div>
          </div>
        </form>
      </div>

      <div class="col-md-6 text-right">
        <a href="{{ route('visitas.create') }}" class="btn btn-info">
          <i class="fa fa-plus"></i> Cadastrar
        </a>
      </div>
      <hr>

      <div class="col-md-12 table-responsive">
        <table class="table table-hover" style="text-align: center">
          <thead>
            <tr>
              <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Paciente</th>
                <th>Visitante</th>
                <th>Data</th>
                <th>Horário</th>

              </tr>
            </tr>
          </thead>
          <tbody>
            @foreach($visitas as $e)
            <tr>
              <td>{{$e->id}}</td>
              <td>
                @if($e->status_visita == 1)Solicitado

                @elseif($e->status_visita == 2)Aprovado

                @elseif($e->status_visita == 3)Negado

                @endif</td>
              <td>{{$e->paciente->nome}}</td>
              <td>{{$e->user->name}}</td>
              <td>{{$e->data_visita}}</td>
              <td>{{$e->hora_visita}}</td>

            </tr>

            @endforeach
          </tbody>
        </table>
        <div>
          <a class="btn btn-secondary" role="button" href="{{route('visitas.index')}}">
            <i class="fa fa-arrow-left"></i> Voltar
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
