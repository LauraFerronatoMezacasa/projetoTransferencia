<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{    
    public function welcome(){
        $usuario = Auth::user();
        if($usuario->id) {
            $results = DB::select('select * from cashs where idUser = ?', [$usuario->id]);
        }

        $transferenciasRecebidas = DB::select('select t.id, t.idUser, t.idTargetUser, t.cash, t.created_at, u.nome from transfers t INNER JOIN users u ON t.idUser = u.id WHERE idTargetUser = ?', [Auth::user()->id]);
        $transferenciasEnviadas = DB::select('select t.id, t.idUser, t.idTargetUser, t.cash, t.created_at, u.nome from transfers t INNER JOIN users u ON t.idTargetUser = u.id WHERE idUser = ?', [Auth::user()->id]);
        
        return view('home')->with('results', $results)->with('transferenciasRecebidas', $transferenciasRecebidas)->with('transferenciasEnviadas', $transferenciasEnviadas);
    }
}
