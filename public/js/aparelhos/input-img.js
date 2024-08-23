const fileInput = document.getElementById('image');
const customFileUpload = document.querySelector('.lbl-img');
const icon = document.querySelector('.fa-solid');
const textDiv = document.getElementById('img-text');
                
fileInput.addEventListener('change', function() {
    if (fileInput.files.length > 0) {
        const isImage = /^image\//.test(fileInput.files[0].type);

        if (isImage) {
            customFileUpload.classList.add('img-selecionada');
            icon.classList.remove('fa-camera');
            icon.classList.add('fa-check');
            textDiv.innerHTML = 'Imagem selecionada!';
        }
        else {
            customFileUpload.classList.remove('img-selecionada');
            icon.classList.add('fa-camera');
            icon.classList.remove('fa-check');
            textDiv.innerHTML = 'Adicionar uma foto';
        }
    }
    else {
        customFileUpload.classList.remove('img-selecionada');
        icon.classList.add('fa-camera');
        icon.classList.remove('fa-check');
        textDiv.innerHTML = 'Adicionar uma foto';
    }
});