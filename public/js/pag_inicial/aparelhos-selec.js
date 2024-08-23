function aparelhosSelecionados() {
    // Obter todos os elementos de checkbox com o mesmo nome
    var aparelho = document.getElementsByName('aparelho[]');

    for (var i = 0; i < aparelho.length; i++) {
        if (aparelho[i].checked) {
            console.log('Opções selecionadas:', aparelho[i].id);
        }
    }
}