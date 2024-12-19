function aparelhosSelecionados() {
    // Obter todos os elementos de checkbox com o mesmo nome
    var aparelho = document.getElementsByName('aparelho[]');

    for (var i = 0; i < aparelho.length; i++) {
        if (aparelho[i].checked) {
            console.log('Opções selecionadas:', aparelho[i].id);
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const calendar = document.getElementById("calendar");
    const dataAgendSpan = document.getElementById("data-agend");
    const dataReservaInput = document.getElementById("data-reserva");

    calendar.addEventListener("click", function (event) {
        const clickedDay = event.target.closest("td");

        // Verificar se o dia clicado é válido e não está desabilitado
        if (clickedDay && clickedDay.dataset.date && !clickedDay.classList.contains("disabled")) {
            // Obter a data selecionada
            const selectedDate = new Date(clickedDay.dataset.date);

            // Formatar a data no formato dia/mês/ano
            const day = selectedDate.getDate();
            const month = selectedDate.toLocaleString('pt-BR', { month: 'short' });
            const year = selectedDate.getFullYear();
            const formattedDate = `${day} ${month} ${year}`;

            // Atualizar o span com a data formatada
            dataAgendSpan.textContent = `para ${formattedDate}`;

            // Atualizar o campo input hidden com a data no formato YYYY-MM-DD
            dataReservaInput.value = selectedDate.toISOString().split('T')[0];

            // Adicionar destaque ao dia selecionado e remover de outros
            const allDays = calendar.querySelectorAll("td");
            allDays.forEach(day => day.classList.remove("highlight"));
            clickedDay.classList.add("highlight");
        }
    });
});
