<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Notifications\Notifiable;

class UserController extends Controller
{
    use Notifiable;
    
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function cadastro() {
        return view('cadastro');
    }

    public function store(StoreUserRequest $request)
    {
        $request->cpf_cnpj = str_replace(array("-", ".", ",", "/"), "", $request->cpfcnpj);

        $usuario = new User();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;    
        $usuario->cpf_cnpj = $request->cpf_cnpj ;
        $usuario->senha = bcrypt($request->senha);

        if (strlen($usuario->cpf_cnpj) == 14) {
            $usuario->tipo = 'L';
        } else {
            $usuario->tipo = 'C';
        }
        
        $result = $usuario->save();
        
        if ($result) {
            return redirect()->route('usuario.inicio')->with('mensagem', 'Usuário cadastrado com sucesso');
        } else {
            return ['mensagem'=>'Ocorreu um erro ao salvar, por favor, tente novamente.'];
        }        
    }
}
