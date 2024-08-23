document.addEventListener("DOMContentLoaded", function() {
    let currentYear, currentMonth;
    const calendar = document.getElementById("calendar");
    const prevButton = document.getElementById("prev");
    const nextButton = document.getElementById("next");
    const monthTitle = document.getElementById("monthTitle");

    function createCalendar(year, month) {
        currentYear = year;
        currentMonth = month;

        const months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
        const daysOfWeek = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const firstDay = new Date(year, month, 1).getDay();
        const lastDayOfprev = new Date(year, month, 0).getDate();

        // Atualiza o título do mês
        monthTitle.textContent = `${months[month]} ${year}`;
        
        let html = `<table><tr>`;

        for (let i = 0; i < daysOfWeek.length; i++) {
            html += `<th>${daysOfWeek[i]}</th>`;
        }

        html += "</tr><tr>";

        // Preenche os dias do mês anterior
        for (let day = lastDayOfprev - firstDay + 1; day <= lastDayOfprev; day++) {
            html += `<td class="other-month">${day}</td>`;
        }

        for (let day = 1; day <= daysInMonth; day++) {
            // Adiciona a classe "dia-atual" apenas ao dia atual no mês atual
            if (
                year === today.getFullYear() &&
                month === today.getMonth() &&
                day === today.getDate()
            ) {
                html += `<td class="dia-atual">${day}</td>`;
            } else {
                html += `<td>${day}</td>`;
            }

            if ((firstDay + day) % 7 === 0) {
                html += "</tr><tr>";
            }
        }

        // Preenche os dias do próximo mês
        const lastDay = new Date(year, month + 1, 0).getDay();
        const remainingDays = 6 - lastDay;
        for (let day = 1; day <= remainingDays; day++) {
            html += `<td class="other-month">${day}</td>`;
        }

        html += "</tr></table>";
        calendar.innerHTML = html;
    }

    function showPreviousMonth() {
        if (currentMonth === 0) {
            currentYear--;
            currentMonth = 11;
        } else {
            currentMonth--;
        }
        createCalendar(currentYear, currentMonth);
    }

    function shownext() {
        if (currentMonth === 11) {
            currentYear++;
            currentMonth = 0;
        } else {
            currentMonth++;
        }
        createCalendar(currentYear, currentMonth);
    }

    function getMesAbrev(numMes) {
        const mesesAbrev = [
            "Jan",
            "Fev",
            "Mar",
            "Abr",
            "Mai",
            "Jun",
            "Jul",
            "Ago",
            "Set",
            "Out",
            "Nov",
            "Dez"
        ];

        if (numMes >= 0 && numMes <= 11) {
            return mesesAbrev[numMes];
        }
    }

    const today = new Date();

    // Função marcar data
    function showDate(event) {
        const clickedDay = event.target.closest("td");
        if (clickedDay) {

            // Verifica se o elemento clicado é uma célula da tabela
            if (!clickedDay.classList.contains("other-month")) {
                const clickedDate = new Date(currentYear, currentMonth, parseInt(event.target.textContent, 10));

                // Compara a data clicada com a data atual
                if (clickedDate.getTime() > today.getTime())  {
                     dataClicada = `${currentYear}-${currentMonth + 1}-${clickedDate.getDate()}`;

                    let dia = document.getElementById("data-reserva");
                    let dataClicadaObj = typeof dataClicada === 'string' ? new Date(dataClicada) : dataClicada;

                    // Obtém o ano, mês e dia da dataClicadaObj
                    let ano = dataClicadaObj.getFullYear();
                    let mes = String(dataClicadaObj.getMonth() + 1).padStart(2, '0'); // Adiciona zero à esquerda se necessário
                    let diaDoMes = String(dataClicadaObj.getDate()).padStart(2, '0'); // Adiciona zero à esquerda se necessário
                    
                    // Concatena ano, mês e dia em uma string no formato "yyyy-mm-dd"
                    let dataFormatada = `${ano}-${mes}-${diaDoMes}`;
                    
                    // Define o valor do elemento dia com a data formatada
                    dia.value = dataFormatada;
                    // Remove a classe "highlight" de todos os dias
                    const allDays = document.querySelectorAll("td");
                    allDays.forEach(day => day.classList.remove("highlight"));

                    // Adiciona a classe "highlight" ao dia clicado
                    clickedDay.classList.add("highlight");

                    let spanDate = document.getElementById("data-agend");
                    spanDate.innerHTML = `para ${clickedDate.getDate()} ${getMesAbrev(clickedDate.getMonth())} ${clickedDate.getFullYear()}`;
                }
            }
        }
    }

    // Adiciona um event listener aos elementos da tabela
    calendar.addEventListener("click", showDate);

    prevButton.addEventListener("click", showPreviousMonth);
    nextButton.addEventListener("click", shownext);

    createCalendar(today.getFullYear(), today.getMonth());
});

