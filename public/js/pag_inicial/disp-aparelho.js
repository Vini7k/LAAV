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
