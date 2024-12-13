  @include('conexao')

  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>LAAV</title>
      <link rel="stylesheet" href="{{ asset('css/nav-bar.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/agendamentos.css') }}">
      <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script> 
  </head>
  <body>
      <header>
          <x-nav-bar/>
      </header>
        <div class='caixa'>
          <div class='div-principal'>
                <h1>AGENDAMENTOS</h1>
                <div class=form-step>
                  <x-tabela></x-tabela>
                </div>
          </div>
      </div>
      
  </body>
  </html>