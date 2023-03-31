let iconEvent = document.querySelector("#iconEvent");
let formEvent = document.querySelector(".form-event");

iconEvent.addEventListener('click', ()=>{
    iconEvent.classList.toggle('bi-arrow-right-circle-fill');
    formEvent.classList.toggle('d-none');
})