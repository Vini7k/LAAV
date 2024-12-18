function preencherHorarios() {
    const horarioRetirada = document.getElementById('horario_emprestimo');
    const horarioDevolucao = document.getElementById('horario_devolucao_emprestimo');
    
    const startTime = 7; 
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