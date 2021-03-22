<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransferRequest;
use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function transferencias() {
        $usuario = Auth::user();
        return view('transferir');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
    public function store(StoreTransferRequest $request)
    {
        $request->cpf_cnpj = str_replace(array("-", ".", ",", "/"), "", $request->cpfcnpj);
        $request->valor = str_replace(".", "", $request->valor);
        $request->valor = str_replace(",", ".", $request->valor);

        $destinatarios = DB::select('select * from users where cpf_cnpj = ?', [$request->cpf_cnpj]);
        $valor = DB::select('select * from cashs where idUser = ?', [Auth::user()->id]);
        
        foreach ($valor as $val) {
            $valorUsuario = $val->cash;
        }

        if ($destinatarios && $valorUsuario >= $request->valor) {
            $transferencia = new Transfer();
            $transferencia->idUser = Auth::user()->id;
            foreach ($destinatarios as $destinatario) {
             $transferencia->idTargetUser = $destinatario->id;
             $destinatarioID = $destinatario->id;
             $valorDestinatario = DB::select('select * from cashs where idUser = ?', [$destinatario->id]);
            }    
            $transferencia->cash = $request->valor;
            
            $url = "https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            $resp = curl_exec($ch);
            curl_close($ch);
            $objeto = json_decode($resp);
            
            if ($objeto->message == "Autorizado") {
                $result = $transferencia->save();
                foreach($valorDestinatario as $valorDest) {
                    $novoValorDest = $valorDest->cash + $request->valor;
                }
                $novoValorRemet = $valorUsuario - $request->valor;    
            } else {
                $result = false;
            }

            if ($result) {
                DB::update('update cashs set cash = ? where idUser = ?',[$novoValorDest, $destinatarioID]);

                DB::update('update cashs set cash = ? where idUser = ?',[$novoValorRemet, Auth::user()->id]);
                $notificacao = $this->enviaNotificacao($destinatarioID);
                if ($notificacao == true) {
                    return redirect()->route('usuario.welcome')->with('mensagemTrue', 'Transferência e notificação enviada com sucesso!');
                } else {
                    return redirect()->route('usuario.welcome')->with('mensagemFalse', 'Transferência enviada com sucesso!');
                }
                
            } else {
                return ['mensagem'=>'Ocorreu um erro ao salvar, por favor, tente novamente.'];
            }        
        } else {
            if ($valorUsuario < $request->valor) {
                return redirect()->route('usuario.transferencias')->with('mensagem', 'Saldo insuficiente!');
            } else {
                return redirect()->route('usuario.transferencias')->with('mensagem', 'Usuário não encontrado!');
            }
        }
        
    }

    public function enviaNotificacao($targetUser) {
        $url = "https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $resp = curl_exec($ch);
        curl_close($ch);
        $objeto = json_decode($resp);
        
        if ($objeto->message == "Enviado") {
            return true;
        } else {
            return false;
        }
    }


}
