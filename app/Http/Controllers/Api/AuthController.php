<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function inicio() {
        return view('login');
    }

    public function login(StoreAuthRequest $request)
    {
        $dados = $request->all();
        $usuario = User::where('email', $dados['email'])->first();

        $dinheiro = DB::select('select * from cashs where idUser = ?', [$usuario->id]);
        if (!$dinheiro) {
            DB::insert('insert into cashs (idUser, cash) values (?, 100.00)', [$usuario->id]);
        }

        if (Auth::check() || ($usuario && Hash::check($dados['senha'], $usuario->senha))) {
            Auth::login($usuario, true);
            return redirect()->route('usuario.welcome');
        } else {
            return redirect()->route('usuario.inicio')->with('mensagens', 'Usuário ou senha incorretos!');
        }
   }

   public function logout()
   {
        Auth::logout();
       
        return redirect()->route('usuario.inicio');
   }

}
