@extends('adminlte::page')

@section('title', 'VisitSys')

@section('content')

@can('is_admin')

<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carousel" data-slide-to="0" class="active"></li>
      <li data-target="#carousel" data-slide-to="1"></li>
      <li data-target="#carousel" data-slide-to="2"></li>
      <li data-target="#carousel" data-slide-to="3"></li>
      <li data-target="#carousel" data-slide-to="4"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block" style="width:100%; height:80vh;" src="../../vendor/adminlte/dist/img/slide01.jpg" alt="slide01">
      </div>
      <div class="carousel-item">
        <img class="d-block" style="width:100%; height:80vh;" src="../../vendor/adminlte/dist/img/slide02.jpg"  alt="slide02">
      </div>
      <div class="carousel-item">
        <img class="d-block" style="width:100%; height:80vh;" src="../../vendor/adminlte/dist/img/slide03.jpg"  alt="slide03">
      </div>
      <div class="carousel-item">
        <img class"d-block" style="width:100%; height:80vh;" src="../../vendor/adminlte/dist/img/slide04.jpg"  alt="slide04">
      </div>
      <div class="carousel-item">
        <img class"d-block" style="width:100%; height:80vh;" src="../../vendor/adminlte/dist/img/slide05.jpg"  alt="slide05">
      </div>
    </div>


    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

@endcan

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
@stop
