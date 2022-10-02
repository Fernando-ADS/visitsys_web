<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Coordenador;
use App\Models\Paciente;
use App\Models\Recepcionista;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\User;
use App\Http\Requests\StoreAgendamentoRequest;
use App\Http\Requests\UpdateAgendamentoRequest;
use App\Http\Requests\AjaxAgendamentoRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;


class AgendamentoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */



  public function index()
  {
    //$this->authorize('is_admin');
    $agendamentos = Agendamento::orderBy('id')->get();
    return view('agendamentos.index', ['agendamentos' => $agendamentos]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $pacientes = Paciente::get();
    $users = User::get();
    $agendamentos = Agendamento::get();
    return view('agendamentos.create', ['pacientes' => $pacientes, 'users' => $users]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreAgendamentoRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreAgendamentoRequest $request)
  {
    Agendamento::create($request->all());
    toast('Cadastrado com sucesso!','success');
    return redirect()->route('agendamentos.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Agendamento  $agendamento
   * @return \Illuminate\Http\Response
   */
  public function show(Agendamento $agendamento)
  {
    return view('agendamentos.show', ['agendamento' => $agendamento]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Agendamento  $agendamento
   * @return \Illuminate\Http\Response
   */
  public function edit(Agendamento $agendamento)
  {
    $pacientes = Paciente::get();
    $users = User::get();
    return view('agendamentos.edit', ['pacientes' => $pacientes, 'users' => $users, 'agendamento' => $agendamento]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateAgendamentoRequest  $request
   * @param  \App\Models\Agendamento  $agendamento
   * @return \Illuminate\Http\Response
   */

  /*
  public function createVisita()
  {
  $pacientes = Paciente::get();
  $visitantes = Visitante::get();
  $visitas = Visita::get();
}
*/

  public function update(UpdateAgendamentoRequest $request, Agendamento $agendamento)
  {
    $agendamento->fill($request->all());
    $agendamento->save();


    /*
  * Options value
  * 1 - Solicitado / 2 - Aprovado / 3 - Negado
  */

    $status_visita = $request->input('status_agendamento');

    //se o agendamento for aprovado, cria uma nova visita com os mesmos dados
    if ($status_visita == '2') {

      //Model Visita
      $paciente_id = $request->input('paciente_id');
      $user_id = $request->input('user_id');
      $data_visita = $request->input('data_agendamento');
      $hora_visita = $request->input('hora_agendamento');

      $nova_visita = new Visita();
      $nova_visita->fill(array('status_visita' => $status_visita, 'paciente_id' => $paciente_id, 'user_id' => $user_id, 'data_visita' => $data_visita, 'hora_visita' => $hora_visita));
      $nova_visita->save();


      //Pega o email do visitante correspondente
      $users = User::get();
      $email_user = null;
      foreach ($users as $e) {
        if ($e->id == $user_id) {
          $email_user = $e->email;
        }
      }


      //Pega a ala do paciente correspondente
      $pacientes = Paciente::get();
      $ala_paciente = null;
      foreach ($pacientes as $e) {
        if ($e->id == $paciente_id) {
          $ala_paciente = $e->ala;
        }
      }

      //Pega a ala para exibição
      $ala_paciente_final = 0;
      if ($ala_paciente == 1) {
        $ala_paciente_final = 'A';
      } elseif ($ala_paciente == 2) {
        $ala_paciente_final = 'B';
      } elseif ($ala_paciente == 3) {
        $ala_paciente_final = 'C';
      } elseif ($ala_paciente == 4) {
        $ala_paciente_final = 'D';
      } elseif ($ala_paciente == 5) {
        $ala_paciente_final = 'E';
      } else {
        $ala_paciente_final = 'F';
      }


      //Calcula a hora para exibição
      $hora_visita_final = 0;
      if ($hora_visita == 1) {
        $hora_visita_final = 8;
      } elseif ($hora_visita == 2) {
        $hora_visita_final = 9;
      } elseif ($hora_visita == 3) {
        $hora_visita_final = 10;
      } elseif ($hora_visita == 4) {
        $hora_visita_final = 14;
      } elseif ($hora_visita == 5) {
        $hora_visita_final = 15;
      } elseif ($hora_visita == 6) {
        $hora_visita_final = 16;
      } else {
        $hora_visita_final = 17;
      }


      //Gera o QR Code com id da visita e salva na pasta
      $id_visita = $nova_visita->id;
      QrCode::format('png')->size(350)->generate(' ' . date('d/m/Y', strtotime($data_visita)) . ' | ' . $hora_visita_final . 'h' . ' | Ala - ' . $ala_paciente_final, '../resources/qrcodes/qrcode_visita_' . $id_visita . '.png');



      //Envia email para o visitante com o QR Code
      Mail::send('email.visitaConfirmada', ['data_visita' => $data_visita, 'hora_visita' => $hora_visita], function ($mensagem) use ($email_user, $data_visita, $hora_visita, $id_visita) {
        $mensagem->from('visitsys.gestao@gmail.com', 'VisitSys | Gestão Hospitalar');
        $mensagem->to($email_user);
        $mensagem->subject('Resultado do Agendamento');
        $mensagem->attach('../resources/qrcodes/qrcode_visita_' . $id_visita . '.png');
      });
    }


    //se o agendamento não for aprovado, envia email avisando que foi negado
    if ($status_visita == '3') {

      //Pega o email do visitante correspondente
      $user_id = $request->input('user_id');
      $users = User::get();
      $email_user = null;
      foreach ($users as $e) {
        if ($e->id == $user_id) {
          $email_user = $e->email;
        }
      }

      Mail::send('email.visitaNegada', [], function ($mensagem) use ($email_user) {
        $mensagem->from('visitsys.gestao@gmail.com', 'VisitSys | Gestão Hospitalar');
        $mensagem->to($email_user);
        $mensagem->subject('Resultado do Agendamento');
      });
    }

    toast('Atualizado com sucesso!','success');
    return redirect()->route('agendamentos.index');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Agendamento  $agendamento
   * @return \Illuminate\Http\Response
   */
  public function destroy(Agendamento $agendamento)
  { {
      $agendamento->delete();
      toast('Excluído com sucesso!','success');
      return redirect()->route('agendamentos.index');
    }
  }

  public function search()
  {
    $this->authorize('is_admin');
    $pesquisa = $_GET['search'];
    $agendamentos = Agendamento::where('paciente_id', 'LIKE', '%' . $pesquisa . '%')->get();
    return view('agendamentos.search', compact('agendamentos'));
  }


  public function procuraPaciente(AjaxAgendamentoRequest $request)
  {
    $pacientes = Paciente::all();
    $inputPac = ($request->nome_paciente);

    foreach ($pacientes as $p) {
      if ($inputPac == $p->nome) {
        //var_dump('sucesso');
        $idPac['success'] = true;
        $idPac['id'] = $p->id;
        $retorno = json_encode($idPac);
        return ($retorno);
      }
    }

    $idPac['success'] = false;
    $idPac['id'] = null;
    $retorno = json_encode($idPac);
    return ($retorno);
  }




  public function procuraVisitante(AjaxAgendamentoRequest $request)
  {
    $users = User::all();
    $inputVis = ($request->nome_user);

    foreach ($users as $v) {
      if ($inputVis == $v->nome) {
        //var_dump('sucesso');
        $idVis['success'] = true;
        $idVis['id'] = $v->id;
        $retorno = json_encode($idVis);
        return ($retorno);
      }
    }

    $idVis['success'] = false;
    $idVis['id'] = null;
    $retorno = json_encode($idVis);
    return ($retorno);
  }
}
