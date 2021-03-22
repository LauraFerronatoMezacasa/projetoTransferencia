<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entre</title>

    <link rel="stylesheet" href="{{ asset('site/style.css') }}">
</head>
<body>
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" integrity="sha256-u7MY6EG5ass8JhTuxBek18r5YG6pllB9zLqE4vZyTn4=" crossorigin="anonymous"></script>
    <div class="container"> 
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form method="POST" action="{{ route('usuario.login') }}" class="box">
                        @csrf
                        <h1>Login</h1>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Digite o seu email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha: </label>
                            <input class="form-control @error('senha') is-invalid @enderror" type="password" name="senha" id="senha">
                            @error('senha')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group text-center"> 
                            <input type="submit" name="login" value="Login">
                        </div>
                        <a class="forgot text-muted" href="{{ route('usuario.cadastro') }}">É novo? Cadastre-se!</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mensagemCadastro" tabindex="-1" role="dialog" aria-labelledby="mensagemCadastro" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Usuário cadastrado com sucesso!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mensagemErro" tabindex="-1" role="dialog" aria-labelledby="mensagemErro" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Usuário ou senha inválidos!</p>
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
            $('#mensagemCadastro').modal('show');
        });
    </script>
@endif


@if(session('mensagens'))
    <script>
        $(function() {
            $('#mensagemErro').modal('show');
        });
    </script>
@endif
