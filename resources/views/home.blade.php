<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="{{ asset('site/style.css') }}">
</head>
<body>
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    
    <!-- Menu superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="nav navbar-nav">
          <li class="nav-item dropdown">
            <span class="navbar-text my-2 my-lg-0">
              Olá, {{ Auth::user()->nome }}!
            </span>
          </li>
          <li class="nav-item dropdown">
            <a href="{{ route('usuario.logout') }}"><i class="fas fa-sign-out-alt"></i></a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Conteúdo informações -->
    <div class="conteudo">
      <div class="infos"> 
        <h1> Olá, {{ Auth::user()->nome }}! </h1>
        <h3> Seu saldo atual: </h3>
        @if ($results)
        @foreach ($results as $result)
            <p> R$ {{ number_format($result->cash, 2, ',', '.') }} </p>
        @endforeach
        @else
          <p> R$ 0,00 </p>
        @endif
        @if (Auth::user()->tipo == 'C')
          <a class="forgot text-muted" href="{{ route('usuario.transferencias') }}">Realizar nova transferência!</a>
        @endif
      </div>
      <hr />

      @if($transferenciasRecebidas)
      <div class="transferencias">
        <div class="recebidas">
          <h4>Transferências recebidas</h4>
          <table> 
            <thead>
            <tr>
              <th>Valor</th>
              <th>Remetente</th>
              <th>Data</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($transferenciasRecebidas as $transferencia)
              <tr class="item_row">
                <td>R$ {{number_format($transferencia->cash, 2, ',', '.')}}</td>
                <td>{{$transferencia->nome}}</td>
                <td>{{$transferencia->created_at}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <hr />
      @endif

      @if ($transferenciasEnviadas)
      <div class="enviadas">
        <h4>Transferências enviadas</h4>
          <table> 
            <thead>
            <tr>
              <th>Valor</th>
              <th>Destinatário</th>
              <th>Data</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($transferenciasEnviadas as $transferencia)
              <tr class="item_row">
                <td>R$ {{number_format($transferencia->cash, 2, ',', '.')}}</td>
                <td>{{$transferencia->nome}}</td>
                <td>{{$transferencia->created_at}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif

      <div class="modal fade" id="mensagemTrue" tabindex="-1" role="dialog" aria-labelledby="mensagemTrue" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Transferência e a notificação foram enviadas com sucesso!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mensagemFalse" tabindex="-1" role="dialog" aria-labelledby="mensagemFalse" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Transferência enviada com sucesso! Serviço de notificação indisponível.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@if(session('mensagemFalse'))
    <script>
        $(function() {
            $('#mensagemFalse').modal('show');
        });
    </script>
@endif


@if(session('mensagemTrue'))
    <script>
        $(function() {
            $('#mensagemTrue').modal('show');
        });
    </script>
@endif