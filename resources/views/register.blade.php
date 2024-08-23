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
            <h2 id="form-titulo">Cadastrar</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nome -->
                <div class="form-input">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="span-label">Nome</span>
                </div>
                <x-input-error :messages="$errors->get('name')" />

                <!-- Email -->
                <div class="form-input">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <span class="span-label">Email</span>
                </div>
                <x-input-error :messages="$errors->get('email')" />

                <!-- Matrícula -->
                <div class="form-input">
                    <input id="registration" type="text"  name="registration" :value="old('registration')" required autocomplete="off">
                    <span class="icon"><i class="fa-solid fa-id-badge"></i></span>
                    <span class="span-label">Matrícula</span>
                </div>
                <x-input-error :messages="$errors->get('registration')" />

                <!-- Senha -->
                <div class="form-input">
                    <input type="password" id="password" name="password" required autocomplete="off">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <span class="span-label">Senha</span>
                </div>
                <x-input-error :messages="$errors->get('password')" />

                <!-- Confirmação de senha -->
                <div class="form-input">
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="off">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <span class="span-label">Confirmar senha</span>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" />
                
                
                <button type="submit">Cadastrar</button>               
                <div class="link">
                    <span>Já possui conta?</span>
                    <a href="{{ route('login') }}">Faça login</a>
                </div>
          </form>
        </div>
      </div>
</body>
</html>