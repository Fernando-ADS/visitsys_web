<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Agendamento;
use App\Models\Paciente;
use App\Models\Recepcionista;
use App\Models\Visitante;
use App\Models\Visita;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tipo' => ['enum'],
            'cpf' => ['string', 'max:255'],
            'telefone' => ['required', 'string', 'max:255'],
            'endereco' => ['required', 'string', 'max:255'],
            //'foto' => ['string'],

            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $nomeFoto = $data['foto']->getClientOriginalName();
        $extensao = $data['foto']->getClientOriginalExtension();
        $nomeFotoNova = md5($nomeFoto . strtotime("now")) . "." . $extensao;
        $data['foto']->move(public_path('fotosUsuarios'), $nomeFotoNova);
        $data['foto'] = $nomeFotoNova;

        

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipo' => 'user',
            'cpf' => $data['cpf'],
            'telefone' => $data['telefone'],
            'endereco' => $data['endereco'],
            'foto' => $data['foto']

        ]);
    }







}



/*
    if ($request->hasFile('foto')) {
      $requestImage = $request->foto;

      $extensao = $requestImage->extension();
      $nome = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extensao;
      $requestImage->move('../resources/fotos', $nome);

      $request->foto = $nome;
    }
    */

     /* 
    $fileNameToStore = 'casa';

    if($request->hasFile('foto')) {
      $filenameWithExt = $request->file('foto')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('foto')->getClientOriginalExtension();
      $fileNameToStore = $filename . '_' . time() . '.' . $extension;
      //$path = $request->file('foto')->storeAs('public/foto', $fileNameToStore);
    } else {
      dd('erro');
    }

        public function valida(RegisterRequest $request){
        dd($request->all);
    }


    
    $request->foto = $fileNameToStore;
