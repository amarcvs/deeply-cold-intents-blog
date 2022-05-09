const openModalPopups = document.querySelectorAll('[data-modal-target]');
const closeModalPopups = document.querySelectorAll('[data-close-button]');
const overlay = document.getElementById('overlay');

openModalPopups.forEach(button => {
  button.addEventListener('click', () => {
    renderArticle();
    const modal = document.querySelector(button.dataset.modalTarget);
    openModal(modal);
  });
});

overlay.addEventListener('click', () => {
  const modals = document.querySelectorAll('.modal.active');
  modals.forEach(modal => {
    closeModal(modal);
  });
});

closeModalPopups.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.modal');
    closeModal(modal);
  });
});

function openModal(modal) {
  if (modal == null) return;
  modal.classList.add('active');
  overlay.classList.add('active');
}

function closeModal(modal) {
  if (modal == null) return;
  modal.classList.remove('active');
  overlay.classList.remove('active');
}

function renderArticle(){
  title = document.getElementsByClassName('preview-area')[0].childNodes[1].childNodes[1].value;
  text = document.getElementsByClassName('preview-area')[0].childNodes[3].childNodes[1].value;
  
  document.getElementsByClassName('inserted-title')[0].innerHTML = title;
  document.getElementsByClassName('inserted-text')[0].innerHTML = text;
}