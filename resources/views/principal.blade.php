@extends('adminlte::page')
@section('content')


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
        <img class="d-block" style="width:100%; height:80vh;" src="https://inconfidencia-rs.com.br/blog/wp-content/uploads/2019/10/shutterstock_1094344778.jpg" alt="Segundo slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" style="width:100%; height:80vh;" src="https://www.graficabarueri.com.br/assets/media/components/b-main-slider/cores-cmyk.jpg" alt="Terceiro slide">
      </div>
      <div class="carousel-item">
        <img class="d-block" style="width:100%; height:80vh;" src="https://dbriefing.com.br/blog/wp-content/uploads/2018/12/grafica.jpg" alt="Quarto slide">
      </div>
      <div class="carousel-item">
        <img class"d-block" style="width:100%; height:80vh;" src="https://oabcontagem.org.br/wp-content/uploads/2016/10/Grafica-1.jpg" alt="Quinto slide">
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

@endsection
<!--
Fernando Aparecido da Silva - 1518291
-->
