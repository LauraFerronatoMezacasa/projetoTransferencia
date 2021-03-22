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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" integrity="sha256-u7MY6EG5ass8JhTuxBek18r5YG6pllB9zLqE4vZyTn4=" crossorigin="anonymous"></script>
    
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
      <form method="POST" action="{{ route('usuario.transferir') }}">
        <h1> Transferir </h1>
        <div class="form-group">
          <label for="cpfcnpj">CPF/CNPJ do destinatário: </label>
          <input class="form-control @error('cpfcnpj') is-invalid @enderror" type="text" maxlength="18" name="cpfcnpj" id="cpfcnpj">
          @error('cpfcnpj')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="valor">Valor: </label>
          <input class="form-control @error('valor') is-invalid @enderror" type="text" maxlength="18" name="valor" id="valor">
          @error('valor')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
        </div>
        <div class="form-group text-center"> 
          <input type="submit" name="transferir" value="Transferir">
        </div>
      </form>
    </div>

    <div class="modal fade" id="mensagem" tabindex="-1" role="dialog" aria-labelledby="mensagem" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Usuário não encontrado ou saldo insuficiente. Confira os dados!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

@if(session('mensagem'))
    <script>
        $(function() {
            $('#mensagem').modal('show');
        });
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function($){
        $('#cpfcnpj').mask('000.000.000-00', {
        onKeyPress : function(cpfcnpj, e, field, options) {
            const masks = ['000.000.000-000', '00.000.000/0000-00'];
            const mask = (cpfcnpj.length > 14) ? masks[1] : masks[0];
            $('#cpfcnpj').mask(mask, options);
        }
        });

        $('#valor').mask('000.000.000.000.000,00', {reverse: true});

    });
</script>