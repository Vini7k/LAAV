    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LAAV</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/nav-bar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/pag-inicial.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/form.css') }}">
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

                    <form action="{{ route('reserva.store') }}" id="form-agend" name="form-agend" enctype="multipart/form-data" method="POST">
                        @csrf

                        <input hidden type="date" name="data_emprestimo" id="data-reserva">

                        <section id="step-1" class="form-step steps-css">
                            <h2>Selecione o horário de retirada</h2>
                            <div class="step-elem">
                                <select name="horario_emprestimo" id="horario_emprestimo" class="input-time">
                                </select>
                            </div>
                            <div class="step-elem">
                                <button class="button btn-navigate-form-step btn-next" type="button" step_number="2">Avançar</button>
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

                        <section id="step-2" class="form-step div-none steps-css">
                            <h2 class="font-normal">Selecione o horário da devolução</h2>
                            <div class="step-elem">
                                <select name="horario_devolucao_emprestimo" id="horario_devolucao_emprestimo" class="input-time">
                                </select>
                            </div>
                            <div class="step-elem">
                                <button class="button btn-navigate-form-step btn-prev" type="button" step_number="1">Voltar</button>
                                <button class="button btn-navigate-form-step btn-next" type="button" step_number="3">Avançar</button>
                            </div>
                        </section>

                        <section id="step-3" class="form-step div-none steps-css">
                            <h2 class="font-normal">Selecione o equipamento</h2>
                            <div class="step-elem">
                                <select name="aparelho_checkbox[]" id="aparelho_checkbox" multiple>
                                    @foreach($aparelhos as $aparelho)
                                        <option value="{{ $aparelho->id }}">{{ $aparelho->marca . " " . $aparelho->modelo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="step-elem">
                                <button class="button btn-navigate-form-step btn-prev" type="button" step_number="2">Voltar</button>
                                <button class="button submit-btn" type="button" onclick="enviar();">Confirmar</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </main>
        <script src="{{ asset('js/pag_inicial/mini-calendario.js') }}"></script>
        <script src="{{ asset('js/pag_inicial/form.js') }}"></script>
        <script src="{{ asset('js/pag_inicial/aparelhos-selec.js') }}"></script>

        <script type="text/javascript">
            function preencherHorarios() {
                const horarioRetirada = document.getElementById('horario_emprestimo');
                const horarioDevolucao = document.getElementById('horario_devolucao_emprestimo');
                
                const startTime = 6; 
                const endTime = 23; 
                let options = '';

                for (let h = startTime; h < endTime; h++) {
                    for (let m = 0; m < 60; m += 30) {
                        let hour = String(h).padStart(2, '0'); 
                        let minute = String(m).padStart(2, '0'); 
                        options += `<option value="${hour}:${minute}">${hour}:${minute}</option>`;
                    }
                }

                horarioRetirada.innerHTML = options;
                horarioDevolucao.innerHTML = options;
            }

            document.addEventListener('DOMContentLoaded', function () {
                preencherHorarios();
            });

            function enviar() {
                alert("Gravando os dados do agendamento");
                document.getElementById("form-agend").submit();
            }
        </script>
        <script> 
            document.addEventListener('DOMContentLoaded', function () {
                const calendar = document.getElementById('calendar');

                calendar.addEventListener('click', function (event) {
                    const selectedDate = event.target.dataset.date; 
                    if (selectedDate) {
                        document.getElementById('data-reserva').value = selectedDate;
                        atualizarAparelhosDisponiveis();
                    }
                });
            });
        </script>
        <script type="text/javascript">
        function atualizarAparelhosDisponiveis() {
            const horarioEmprestimo = document.getElementById('horario_emprestimo').value;
            const horarioDevolucao = document.getElementById('horario_devolucao_emprestimo').value;
            const dataEmprestimo = document.getElementById('data-reserva').value; // A data que foi selecionada no calendário

            if (!dataEmprestimo || !horarioEmprestimo || !horarioDevolucao) {
                return; 
            }

            fetch(`/aparelhos-disponiveis?horario_emprestimo=${horarioEmprestimo}&horario_devolucao_emprestimo=${horarioDevolucao}&data_emprestimo=${dataEmprestimo}`)
                .then(response => response.json())
                .then(data => {
                    const aparelhoSelect = document.getElementById('aparelho_checkbox');
                    aparelhoSelect.innerHTML = '';

                    data.forEach(aparelho => {
                        const option = document.createElement('option');
                        option.value = aparelho.id;
                        option.textContent = `${aparelho.marca} ${aparelho.modelo}`;
                        aparelhoSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Erro ao buscar aparelhos:', error);
                });
        }
        document.getElementById('horario_emprestimo').addEventListener('change', atualizarAparelhosDisponiveis);
        document.getElementById('horario_devolucao_emprestimo').addEventListener('change', atualizarAparelhosDisponiveis);
        document.getElementById('data-reserva').addEventListener('change', atualizarAparelhosDisponiveis);

        </script>

    </body>

</html>
