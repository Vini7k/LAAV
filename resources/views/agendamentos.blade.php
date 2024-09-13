@include('conexao')

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAAV</title>
    <link rel="stylesheet" href="{{ asset('css/nav-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendario-agend.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/agendamentos.css') }}">
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
    
    <!--<script src="{{ asset('js/fullcalendar-6.1.8/dist/index.global.min.js') }}"></script> -->
    <!--<script src="{{ asset('js/agendamentos_js/calendario-agend.js') }}"></script>-->
    
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
   
</head>
<body>
    <header>
        <x-nav-bar/>
    </header>
    <div class='caixa'>
        <div class='div-principal'>
            <h1 style="position:absolute;top:20%; left: 50%; transform: translate(-50%, -50%);">AGENDAMENTOS</h1>
            <!--<div id='calendar'></div>-->
            <div>
              <div class=form-step>
                <x-tabela></x-tabela>
              </div>
            </div>
        </div>
    </div>
    
</body>
</html>