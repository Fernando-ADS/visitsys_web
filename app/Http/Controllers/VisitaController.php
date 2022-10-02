<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\Coordenador;
use App\Models\Paciente;
use App\Models\Recepcionista;
use App\Models\Visitante;
use App\Models\User;
use App\Http\Requests\StoreVisitaRequest;
use App\Http\Requests\UpdateVisitaRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;

class VisitaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $visitas = Visita::orderBy('id')->get();
    return view('visitas.index', ['visitas' => $visitas]);
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
    $visitas = Visita::get();
    return view('visitas.create', ['pacientes' => $pacientes, 'users' => $users]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreVisitaRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreVisitaRequest $request)
  {
    $visitas = Visita::create($request->all());
    $id_visita = $visitas->id;


    /*
  * Options value
  * 1 - Solicitado / 2 - Aprovado / 3 - Negado
  */

    $status_visita = $request->input('status_visita');



    //se o agendamento for aprovado, cria uma nova visita com os mesmos dados
    if ($status_visita == '2') {

      //Model Visita
      $paciente_id = $request->input('paciente_id');
      $user_id = $request->input('user_id');
      $data_visita = $request->input('data_visita');
      $hora_visita = $request->input('hora_visita');


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
      $id_visita = request()->route('id');
      QrCode::format('png')->size(350)->margin(3)->generate(' ' . date('d/m/Y', strtotime($data_visita)) . ' | ' . $hora_visita_final . 'h' . ' | Ala - ' . $ala_paciente_final, '../resources/qrcodes/qrcode_visita_v' . $id_visita . '.png');


      //Envia email para o visitante com o QR Code
      Mail::send('email.visitaConfirmada', ['data_visita' => $data_visita, 'hora_visita' => $hora_visita], function ($mensagem) use ($email_user, $data_visita, $hora_visita, $id_visita) {
        $mensagem->from('visitsys.gestao@gmail.com', 'VisitSys | Gestão Hospitalar');
        $mensagem->to($email_user);
        $mensagem->subject('Resultado da Visita');
        $mensagem->attach('../resources/qrcodes/qrcode_visita_v' . $id_visita . '.png');
      });
    }

    //Se o agendamento não for aprovado, envia email avisando que foi negado
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
        $mensagem->subject('Resultado da Visita');
      });
    }

    toast('Cadastrado com sucesso!','success');
    return redirect()->route('visitas.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Visita  $visita
   * @return \Illuminate\Http\Response
   */
  public function show(Visita $visita)
  {
    return view('visitas.show', ['visita' => $visita]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Visita  $visita
   * @return \Illuminate\Http\Response
   */
  public function edit(Visita $visita)
  {
    $pacientes = Paciente::get();
    $users = User::get();
    return view('visitas.edit', ['pacientes' => $pacientes, 'users' => $users, 'visita' => $visita]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateVisitaRequest  $request
   * @param  \App\Models\Visita  $visita
   * @return \Illuminate\Http\Response
   */



  public function update(UpdateVisitaRequest $request, Visita $visita)
  {
    $visita->fill($request->all());
    $visita->save();


    /*
  * Options value
  * 1 - Solicitado / 2 - Aprovado / 3 - Negado
  */

    $status_visita = $request->input('status_visita');


    //Model Visita
    $paciente_id = $request->input('paciente_id');
    $user_id = $request->input('user_id');
    $data_visita = $request->input('data_visita');
    $hora_visita = $request->input('hora_visita');


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


    //se o agendamento for aprovado, cria uma nova visita com os mesmos dados
    if ($status_visita == '2') {


      //Pega o email do visitante correspondente
      $users = User::get();
      $email_user = null;
      foreach ($users as $e) {
        if ($e->id == $user_id) {
          $email_user = $e->email;
        }
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
      $id_visita = $visita->id;
      QrCode::format('png')->size(350)->margin(3)->generate(' ' . date('d/m/Y', strtotime($data_visita)) . ' | ' . $hora_visita_final . 'h' . ' | Ala - ' . $ala_paciente_final, '../resources/qrcodes/qrcode_visita_v' . $id_visita . '.png');



      //Envia email para o visitante com o QR Code
      Mail::send('email.visitaConfirmada', ['data_visita' => $data_visita, 'hora_visita' => $hora_visita], function ($mensagem) use ($email_user, $data_visita, $hora_visita, $id_visita) {
        $mensagem->from('visitsys.gestao@gmail.com', 'VisitSys | Gestão Hospitalar');
        $mensagem->to($email_user);
        $mensagem->subject('Resultado do Agendamento');
        $mensagem->attach('../resources/qrcodes/qrcode_visita_v' . $id_visita . '.png');
      });
    }


    //Se o agendamento não for aprovado, envia email avisando que foi negado
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
        $mensagem->subject('Resultado da Visita');
      });
    }

    $visita->fill(array('status_visita' => $status_visita, 'paciente_id' => $paciente_id, 'user_id' => $user_id, 'data_visita' => $data_visita, 'hora_visita' => $hora_visita));
    $visita->save();

    toast('Atualizado com sucesso!','success');
    return redirect()->route('visitas.index');
  }






  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Visita  $visita
   * @return \Illuminate\Http\Response
   */

  public function destroy(Visita $visita)
  { {
      $visita->delete();
      toast('Excluído com sucesso!','success');
      return redirect()->route('visitas.index');
    }
  }

  public function search()
  {
    $pesquisa = $_GET['search'];
    $visitas = Visita::where('paciente_id', 'LIKE', '%' . $pesquisa . '%')->get();

    return view('visitas.search', compact('visitas'));
  }
}
