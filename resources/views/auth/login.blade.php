<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAAV</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cad-lgin.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div id="div-principal">
        <div id="form-div">
            <h2 id="form-titulo">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-input">
                    <input id="email" type="email" name="email"  :value="old('email')" required autocomplete="username">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="span-label">Email</span>
                </div>

                <!-- Senha -->
                <div class="form-input">
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <span class="span-label">Senha</span>                    
                </div>
                <div class="link esq-senha">
                    <a href="{{ route('esq-senha') }}">Esqueceu sua senha?</a>
                </div>
                <button>Login</button>
                <div class="link">
                    <span>Não possui uma conta?</span>
                    <a href="{{ route('register') }}">Criar conta</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>