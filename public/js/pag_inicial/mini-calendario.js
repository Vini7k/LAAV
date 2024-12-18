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
        const lastDayOfPrev = new Date(year, month, 0).getDate();

        monthTitle.textContent = `${months[month]} ${year}`;
        
        let html = `<table><tr>`;
        for (let i = 0; i < daysOfWeek.length; i++) {
            html += `<th>${daysOfWeek[i]}</th>`;
        }
        html += "</tr><tr>";

        for (let day = lastDayOfPrev - firstDay + 1; day <= lastDayOfPrev; day++) {
            html += `<td class="other-month">${day}</td>`;
        }

        const today = new Date();
        const endOfNextWeek = new Date(today);
        endOfNextWeek.setDate(today.getDate() + (7 - today.getDay()) + 7); 

        for (let day = 1; day <= daysInMonth; day++) {
            const clickedDate = new Date(year, month, day);

            if (clickedDate.getTime() >= today.getTime() && clickedDate.getTime() <= endOfNextWeek.getTime()) {
                const isSunday = clickedDate.getDay() === 0; 

                if (!isSunday) {
                    html += `<td data-day="${day}" data-date="${clickedDate.toISOString()}">${day}</td>`;
                } else {
                    html += `<td class="disabled" data-day="${day}" data-date="${clickedDate.toISOString()}">${day}</td>`;
                }
            } else {
                html += `<td class="disabled" data-day="${day}" data-date="${clickedDate.toISOString()}">${day}</td>`;
            }

            if ((firstDay + day) % 7 === 0) {
                html += "</tr><tr>";
            }
        }

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

    function showNextMonth() {
        if (currentMonth === 11) {
            currentYear++;
            currentMonth = 0;
        } else {
            currentMonth++;
        }
        createCalendar(currentYear, currentMonth);
    }

    Date.prototype.getWeek = function() {
        const startDate = new Date(this.getFullYear(), 0, 1);
        const days = Math.floor((this - startDate) / (24 * 60 * 60 * 1000));
        return Math.ceil((days + 1) / 7);
    };

    const today = new Date();

    function showDate(event) {
        const clickedDay = event.target.closest("td");
        if (clickedDay) {
            if (!clickedDay.classList.contains("other-month") && !clickedDay.classList.contains("disabled")) {
                const clickedDate = new Date(clickedDay.dataset.date);

                const endOfNextWeek = new Date(today);
                endOfNextWeek.setDate(today.getDate() + (7 - today.getDay()) + 7); // Calcula o próximo domingo (fim da próxima semana)

                // Verificar se a data está dentro do intervalo permitido (hoje + próxima semana inteira)
                if (clickedDate.getTime() >= today.getTime() && clickedDate.getTime() <= endOfNextWeek.getTime()) {
                    const dataClicada = `${currentYear}-${currentMonth + 1}-${clickedDate.getDate()}`;

                    let dia = document.getElementById("data-reserva");
                    let dataClicadaObj = typeof dataClicada === 'string' ? new Date(dataClicada) : dataClicada;

                    let ano = dataClicadaObj.getFullYear();
                    let mes = String(dataClicadaObj.getMonth() + 1).padStart(2, '0'); 
                    let diaDoMes = String(dataClicadaObj.getDate()).padStart(2, '0');
                    
                    let dataFormatada = `${ano}-${mes}-${diaDoMes}`;
                    
                    dia.value = dataFormatada;

                    const allDays = document.querySelectorAll("td");
                    allDays.forEach(day => day.classList.remove("highlight"));

                    clickedDay.classList.add("highlight");

                    let spanDate = document.getElementById("data-agend");
                    spanDate.innerHTML = `para ${clickedDate.getDate()} ${getMesAbrev(clickedDate.getMonth())} ${clickedDate.getFullYear()}`;
                }
            }
        }
    }

    calendar.addEventListener("click", showDate);

    prevButton.addEventListener("click", showPreviousMonth);
    nextButton.addEventListener("click", showNextMonth);

    createCalendar(today.getFullYear(), today.getMonth());

    document.addEventListener('DOMContentLoaded', function () {
        const calendar = document.getElementById('calendar');

        calendar.addEventListener('click', function (event) {
            const selectedDate = event.target.dataset.date; 
            if (selectedDate) {
                // Atualiza o campo de input com a data selecionada
                document.getElementById('data-reserva').value = selectedDate;

                // Atualiza o span com o dia formatado
                const clickedDate = new Date(selectedDate);
                const day = clickedDate.getDate();
                const month = clickedDate.toLocaleString('pt-BR', { month: 'short' });
                const year = clickedDate.getFullYear();

                const formattedDate = `${day} ${month} ${year}`;
                document.getElementById('data-agend').textContent = `para ${formattedDate}`;

                // Chama a função para atualizar os aparelhos disponíveis
                atualizarAparelhosDisponiveis();
            }
        });
    });
});
