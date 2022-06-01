/* custom modal messages scripts */
const openModalPopups = document.querySelectorAll('[data-modal-target]');

const closeModalPopups = document.querySelectorAll('[data-close-button]');
const overlay = document.getElementById('overlay');

openModalPopups.forEach(button => {
    button.addEventListener('click', () => {
        if(button.id) renderChangingBox(button.id);
        else renderArticle();
        const modal = document.querySelector(button.dataset.modalTarget);
        openModal(modal);
    });
});

overlay.addEventListener('click', () => {
    const modals = document.querySelectorAll('.modalMsg.active');
    modals.forEach(modal => {
        closeModal(modal);
    });
});

closeModalPopups.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.modalMsg');
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
    let title = document.getElementsByClassName('preview-area')[0].childNodes[1].childNodes[1].value;
    let text = document.getElementsByClassName('preview-area')[0].childNodes[3].childNodes[1].value;
  
    document.getElementsByClassName('inserted-title')[0].innerHTML = title;
    document.getElementsByClassName('inserted-text')[0].innerHTML = text;
}

function renderChangingBox(tag) {
    let box = document.getElementsByClassName('modalMsg-body');
    let setting = "";
    let type = "text";
    let btnValue = "";
    if(tag == "changeEmailBtn") { setting = "a_email"; btnValue = "email" }
    else if(tag == "changeUsernameBtn") { setting = "a_username"; btnValue = "username" }
    else if(tag == "changePasswordBtn") { setting = "a_pw"; type = "password"; btnValue = "password" }
    let form = `
    <form class="formDiv" action="../includes/change_settings.inc.php?set=${setting}" method="post" name="form" id="" enctype="multipart/form-data" onSubmit="return checkSingupForm();">
      <div class="row">
          <input type="${type}" name="${setting}" placeholder="INSERT HERE" maxlength="30">
          <input type="submit" name="settingBtn" value="Change ${btnValue}" class="btn">
      </div>
    </form>`;
    box[0].innerHTML = form;
}