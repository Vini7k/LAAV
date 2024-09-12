@include('conexao')

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAAV</title>
    <link rel="stylesheet" href="{{ asset('css/nav-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendario-agend.css') }}">

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
    <style>
      .form-step {
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        padding: 3rem;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size:1.5em;"
      }
    </style>
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
                <x-paginateste></x-paginateste>
              </div>
            </div>
        </div>
    </div>
    
</body>
</html>