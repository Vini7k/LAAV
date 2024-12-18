// Defina uma função para navegar entre as etapas do formulário. 
// Aceita um parâmetro. Isto é - número da etapa.
const navigateToFormStep = (stepNumber) => {

    // Oculte todas as etapas do formulário.
    document.querySelectorAll(".form-step").forEach((formStepElement) => {
        formStepElement.classList.add("div-none");
    });

    // Marca todas as etapas do formulário como inacabadas.
    document.querySelectorAll(".span-circle").forEach((formStepHeader) => {
        formStepHeader.classList.add("form-stepper-unfinished");
        formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
        formStepHeader.classList.remove("progress-line-completed");
    });

    // Marca todas as linhas do formulário como inacabadas.
    document.querySelectorAll(".progress-line").forEach((Line) => {
        Line.classList.remove("progress-line-completed");
    });

    // Mostra a etapa atual do formulário (conforme passado para a função).
    document.querySelector("#step-" + stepNumber).classList.remove("div-none");

    // Seleciona o círculo de etapas do formulário (barra de progresso).
    const formStepCircle = document.querySelector('div[step="' + stepNumber + '"]');
    const progressLine = document.querySelector('span[step="' + (stepNumber - 1) + '"]');

    // Marca a etapa atual do formulário como ativa.
    formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
    formStepCircle.classList.add("form-stepper-active");
    /**
     * Faz um loop em cada círculo de etapas do formulário.
     * Este loop continuará até o número da etapa atual.
     * Exemplo: Se o passo atual for 3,
     * então o loop executará as operações para as etapas 1 e 2.
     */
    for (let index = 0; index < stepNumber; index++) {

        // Seleciona o círculo de etapas do formulário (barra de progresso).
        const formStepCircle = document.querySelector('div[step="' + index + '"]');
        const progressLine = document.querySelector('span[step="' + index + '"]');

        // Verifica se o elemento existe. Se sim, então prossiga.
        if (formStepCircle && progressLine) {

            // Marca a etapa do formulário como concluída.
            formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
            formStepCircle.classList.add("form-stepper-completed");
            progressLine.classList.add("progress-line-completed");
        }
    }
};

// Seleciona todos os botões de navegação do formulário e percorra-os.
document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {

    // Adicione um ouvinte de evento de clique ao botão.
    formNavigationBtn.addEventListener("click", () => {

        // Obtenha o valor da etapa.
        const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));

        // Chame a função para navegar até a etapa do formulário de destino.
        navigateToFormStep(stepNumber);
    });
});


function cancelarSelecao() {
    preencherHorarios()

    const highlightedDays = document.querySelectorAll('td.highlight');
    highlightedDays.forEach(day => day.classList.remove('highlight'));
    
}