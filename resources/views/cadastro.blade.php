<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>

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
                    <form method="POST" action="{{ route('usuario.cadastrar') }}" class="box">
                        @csrf
                        <h1>Cadastre-se!</h1>
                        <div class="form-group">
                            <label for="nome">Nome Completo: </label>
                            <input class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" id="nome" placeholder="Digite seu nome completo">
                            @error('nome')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cpfcnpj">CPF/CNPJ: </label>
                            <input class="form-control @error('cpfcnpj') is-invalid @enderror" type="text" maxlength="18" name="cpfcnpj" id="cpfcnpj">
                            @error('cpfcnpj')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
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
                            <input type="submit" name="cadastro" value="Cadastrar">
                        </div>
                        <a class="forgot text-muted" href="{{ route('usuario.inicio') }}">Já possui conta? Entre!</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function($){
        $('#cpfcnpj').mask('000.000.000-00', {
        onKeyPress : function(cpfcnpj, e, field, options) {
            const masks = ['000.000.000-000', '00.000.000/0000-00'];
            const mask = (cpfcnpj.length > 14) ? masks[1] : masks[0];
            $('#cpfcnpj').mask(mask, options);
        }
        });

    });
</script>