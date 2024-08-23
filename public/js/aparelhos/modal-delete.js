const btnModal = document.querySelector(".btn-modal-deletar");
const modal = document.querySelector(".modal-delete");
const btnCancel = document.querySelector(".btn-cancel-delete");

btnModal.addEventListener('click', () => {
    modal.showModal();
});

btnCancel.addEventListener('click', () => {
    modal.close();
});