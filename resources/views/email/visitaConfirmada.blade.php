<div class="container">
  <div class="container-fluid">
    <img class="img" src="../../imagens/VisitSys_logo.png" width="100" alt="logo">

  </div>

<?php
  $horario = null;
  if($hora_visita == 1){
    $horario = '08:00h';
  }
  elseif ($hora_visita == 2) {
    $horario = '09:00h';
  }
  elseif ($hora_visita == 3) {
    $horario = '10:00h';
  }
  elseif ($hora_visita == 4) {
    $horario = '14:00h';
  }
  elseif ($hora_visita == 5) {
    $horario = '15:00h';
  }
  elseif ($hora_visita == 6) {
    $horario = '16:00h';
  }
  elseif ($hora_visita == 7) {
    $horario = '17:00h';
  }
  else {
    $horario = null;
  }
?>

  <div class="container-fluid">
      <h3>Visita Confirmada</h3>
        <p>Data: {{$data_visita}}</p>
        <p>Horário: {{$horario}}</p>

  </div>
</div>
