<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAAV</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nav-bar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pag-inicial.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form.css')  }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <header>
        <x-nav-bar />
    </header>
    <main>
        <div class="calendar-container">
            <div class="header-calendar">
                <button id="prev" class="fa-solid fa-chevron-left"></button>
                <h3 id="monthTitle">Mini Calendário</h3>
                <button id="next" class="fa-solid fa-chevron-right"></button>
            </div>
            <div id="calendar"></div>
        </div>
        <div class="agend">
            <div class="header-agend">
                <h2>Nova Reserva</h2>
                <span id="data-agend">para . . .</span>
            </div>
            <div id="form-container">
                <div id="form-steps">
                    <ul class="form-stepper">
                        <li>
                            <div class="span-circle form-stepper-active" step="1">1</div>
                            <div class="label">Horário</div>
                        </li>
                        <span class="progress-line" step="1"></span>
                        <li>
                            <div class="span-circle form-stepper-unfinishedcle" step="2">2</div>
                            <div class="label">Devolução</div>
                        </li>
                        <span class="progress-line" step="2"></span>
                        <li>
                            <div class="span-circle form-stepper-unfinishedcle" step="3">3</div>
                            <div class="label">Equipamentos</div>
                        </li>
                    </ul>
                </div>

                <!-- FORMULÁRIO -->
                <form action="{{ route('reserva.store') }}" id="form-agend" name="form-agend"
                    enctype="multipart/form-data" method="POST">
                    @csrf

                    <input hidden type="date" name="data_emprestimo" id="data-reserva">

                    <!-- Step 1 -->
                    <section id="step-1" class="form-step">
                        <h2>Selecione o horário de retirada</h2>
                        <div class="step-elem">
                            <input type="time" name="horario_emprestimo" class="input-time">
                        </div>
                        <div class="step-elem">
                            <button class="button btn-navigate-form-step btn-next" type="button"
                                step_number="2">Avançar</button>
                        </div>
                        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    </section>

                    <!-- Step 2 -->
                    <section id="step-2" class="form-step div-none">
                        <h2 class="font-normal">Selecione o horário da devolução</h2>
                        <div class="step-elem">
                            <input type="time" name="horario_devolucao_emprestimo" class="input-time">
                        </div>
                        <div class="step-elem">
                            <button class="button btn-navigate-form-step btn-prev" type="button"
                                step_number="1">Voltar</button>
                            <button class="button btn-navigate-form-step btn-next" type="button"
                                step_number="3">Avançar</button>
                        </div>
                    </section>

                    <!-- Step 3 -->
                    <section id="step-3" class="form-step div-none">
                        <h2 class="font-normal">Selecione o equipamento</h2>
                        <div class="step-elem">
                            <select name="aparelho_checkbox[]" id="aparelho_checkbox" multiple>
                                @foreach($aparelhos as $aparelho)
                                <option value="{{ $aparelho->id }}">{{ $aparelho->marca . " " . $aparelho->modelo }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="step-elem">
                            <button class="button btn-navigate-form-step btn-prev" type="button"
                                step_number="2">Voltar</button>
                            <button class="button submit-btn" type="submit">Confirmar</button>
                        </div>
                    </section>
                    
                </form>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/pag_inicial/mini-calendario.js') }}"></script>
    <script src="{{ asset('js/pag_inicial/form.js') }}"></script>
    <script src="{{ asset('js/pag_inicial/aparelhos-selec.js')}}"></script>
</body>

</html>
