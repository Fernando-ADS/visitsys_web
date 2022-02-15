@extends('adminlte::page')
@section('content')


<div class="card">
  <div class="card-header">
    <i class="fa fa-bullhorn" aria-hidden="true"></i>
    <h5>Fale Conosco</h5>
    <hr class="m-b-5">


    <section class="content">

      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
              <img class="img" src="../../vendor/adminlte/dist/img/VisitSys_logo.png" width="250" alt="logo">
          </div>
          <div class="col-7">
            <div class="form-group">
              <label for="inputName">Nome</label>
              <input type="text" id="inputName" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputEmail">Email</label>
              <input type="email" id="inputEmail" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputSubject">Assunto</label>
              <input type="text" id="inputSubject" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputMessage">Messagem</label>
              <textarea id="inputMessage" class="form-control" rows="1"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-info" value="Enviar">
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>

</div>

@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->
