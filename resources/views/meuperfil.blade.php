@extends('adminlte::page')
@section('content')


<div class="card">
  <div class="card-header">
    <h5>Perfil do usuário</h5>
    <hr class="m-b-5">


    @section('content')
    <br>
  <h3>Bem-vindo(a), <b>{{strtoupper(current(explode(" ", Auth::user()->name))) }}</b></h3>

  <div class="row">
      <div class="col-md-5">
          <div class="card card-info card-outline">
              <div class="card-body box-profile">
                  <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                      src="../../vendor/adminlte/dist/img/profile2.jpg"
                          alt="User profile picture">
                  </div>
                  <h3 class="profile-username text-center">{{ strtoupper(Auth::user()->name) }}</h3>
                  <!--
                  <p class="text-muted text-center">{{ __('content.user.enum.profile.' . Auth::user()->profile) }}</p>
                -->
                  <ul class="list-group list-group-unbordered mb-3">
                      <br>
                      <li class="list-group-item">
                          <b>Perfil</b> <a class="float-right">{{ Auth::user()->tipo }}</a>
                      </li>
                      <li class="list-group-item">
                          <b>E-mail</b> <a class="float-right">{{ Auth::user()->email }}</a>
                      </li>
                      <li class="list-group-item">
                          <b>Status</b> <a class="float-right">{{ 'Ativo' }}</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
  @stop

  </div>

</div>

@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->
