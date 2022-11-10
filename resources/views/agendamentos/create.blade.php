@extends('adminlte::page')
@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>



<div class="card">
  <div class="card-header">
    <i class="fa fa-info-circle"></i>
    <h5>Cadastro de agendamentos</h5>
    <hr class="m-b-5">
  </div>


  <div class="container-fluid">
    <form class="container-fluid " action="{{route('agendamentos.store')}}" method="post" name="formAgendamento" id="formAgendamento">

      @csrf

      <!--RADIOBUTTON PARA STATUS DO AGENDAMENTO-->
      <div>
        <label for="status_agendamento" id="labelstatus_agendamento">Status:</label>

        <div class="row">
          <div class="col-2">
            <input type="radio" name="status_agendamento" value="1" id="solicitado" checked>
            <label for="solicitado">Solicitado</label>
          </div>

          <div class="col-2">
            <input type="radio" name="status_agendamento" value="2" id="aprovado" disabled>
            <label for="aprovado">Aprovado</label>
          </div>

          <div class="col-2">
            <input type="radio" name="status_agendamento" value="3" id="negado" disabled>
            <label for="negado">Negado</label>
          </div>

        </div>

      </div>


      @can('is_admin')
      <div class="row">
        <div class="col-sm-6">
          <label for="paciente_id" id="labelpaciente_id">Paciente:</label>
          <select name="paciente_id" id="paciente_id" class="form-control" required>

           <option value="" disabled selected>Selecione</option>
            @foreach($pacientes as $e)
            <option value="{{$e->id}}">{{$e->nome}}</option>
            @endforeach
          </select>
        </div>
        @endcan



        <script>
          function transferirValor() {
            jQuery('#nome').val(jQuery('#inputPacInvi').val());
          }
        </script>



        <!--INPUT INVISÍVEL PARA PEGAR NOME DO PACIENTE-->
        <input type="hidden" name="nome" id="nome" value="" class="form-control">



        <!--INPUT PARA USUARIO ESCREVER O NOME DO PACIENTE-->
        @can('is_user')
        <div class="row">
          <div class="col-sm-6">
            <label for="paciente_id" id="labelpaciente_id">Paciente:</label>
            <input type="text" name="inputPacInvi" id="inputPacInvi" value="" class="form-control" onkeyup="transferirValor()" required placeholder="Digite o nome do paciente e clique no botão">
          </div>

          <div class="col-sm-6">
            <label id="val" style="color:white">:</label>
            <br>
            <button type="button" name="validaPaciente" class="btn btn-success" id="validaPaciente">
              <i class="fa fa-check"></i>
            </button>
          </div>
          @endcan



          <!--CABEÇALHO CRSFTOKEN-->
          <script type="text/javascript">
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
          </script>



          <!--INPUT INVISÍVEL PARA ENVIAR O ID DO PACIENTE PARA O FORMULÁRIO-->
          @can('is_user')
          <input type="hidden" name="paciente_id" id="paciente_id" value="" class="form-control" required>
          @endcan




          <!--FUNÇÃO AJAX PEGA PACIENTE-->
          @can('is_user')
          <script>
            $(function() {
              $(document).on("click", "#validaPaciente", function(event) {
                botao = 1;
                event.preventDefault();
                var inputPaciente = $('#inputPacInvi').val();
                nome.value = $('#inputPacInvi').val();
                $('#botaoform').attr('disabled', false);


                $.ajax({
                  url: "{{route('agendamentos.procuraPaciente')}}",
                  type: "post",
                  data: {
                    'nome_paciente': inputPaciente,
                    _token: '{{ csrf_token() }}'
                  },
                  dataType: 'json',
                  success: function(response) {
                    if (response.success === true) {
                      //alert('Paciente encontrado!');
                      paciente_id.value = response.id;
                      //$("#formAgendamento").submit();
                    } else {
                      //alert('Paciente não encontrado!');
                      paciente_id.value = 999;
                      //nome.value = $('#inputPacInvi').val();
                      //inputPacInvi.value = null;
                    }
                  }
                });
              });
            });
          </script>
          @endcan


          @can('is_admin')
          <div class="col-sm-6">
            <label for="user_id" id="labeluser_id">Visitante:</label>
            <select name="user_id" id="user_id" class="form-control">

              <option value="" disabled selected>Selecione</option>
              @foreach($users as $e)
              <option value="{{$e->id}}">{{$e->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        @endcan




        @can('is_user')
        <div class="col-sm-12">
          <label for="user_id" id="labeluser_id">Visitante:</label>
          <input type="text" name="inputVisInvi" id="inputVisInvi" value="<?php echo Auth::user()->name; ?>" class="form-control" required disabled>
        </div>
      </div>
      @endcan


      <!--INPUT INVISÍVEL PARA ENVIAR O ID DO VISITANTE PARA O FORMULÁRIO-->
      @can('is_user')
      <input type="hidden" name="user_id" id="user_id" value="<?php echo Auth::user()->id; ?>" class="form-control" required>
      @endcan



      <!--FUNÇÃO AJAX PEGA VISITANTE
      @can('is_user')
      <script>
      $(function(){
        $(document).on("click", "#validaPaciente", function(event){
          event.preventDefault();
          var inputVisitante =  $('#inputVisInvi').val();

          $.ajax({
            url: "{{route('agendamentos.procuraVisitante')}}",
            type: "post",
            data:{
              'nome_user':inputVisitante,
              _token:'{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(response){
              if(response.success === true){
                //alert('Visitante encontrado!');
                user_id.value = response.id;
                //$('form[name = "formAgendamento"]').submit();
                //break;
              }
              else {
                alert('Visitante não encontrado!');
                user_id.value = null;
                //inputVisInvi.value = null;

              }
            }
          });

        });

      });
      </script>
      @endcan
      -->



      <div class="row">
        <div class="col-sm-6">
          <label for="data_agendamento" id="labelData">Data:</label>
          <input type="date" name="data_agendamento" id="data_agendamento" value="" class="form-control" required min='2022-10-17'>
        </div>


        <div class="col-sm-6">
          <label for="hora_agendamento" id="labelhora_agendamento">Horário:</label>
          <select name="hora_agendamento" id="hora_agendamento" class="form-control" required>
            <option value="" disabled selected>Selecione</option>
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
        @can('is_admin')
        <div>
          <button class="btn btn-info" type="submit">
            <i class="fa fa-plus"></i> Inserir
          </button>
          @endcan



          @can('is_user')
          <div>
            <button class="btn btn-info" type="submit" disabled id="botaoform">
              <i class="fa fa-plus"></i> Inserir
            </button>
            @endcan


            <button class="btn btn-danger" type="reset">
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