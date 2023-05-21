let vacanceZoneA = document.querySelectorAll('.vacanceA');
let vacanceZoneB = document.querySelectorAll('.vacanceB');
let vacanceZoneC = document.querySelectorAll('.vacanceC');


vacanceZoneA.forEach(element => {
    element.innerHTML += '<div class="zoneA"></div>'
});

vacanceZoneB.forEach(element => {
    element.innerHTML += '<div class="zoneB"></div>'
}
);

vacanceZoneC.forEach(element => {
    element.innerHTML += '<div class="zoneC"></div>'
}
);




let iconEvent = document.querySelector("#iconEvent");
let formEvent = document.querySelector(".form-event");

iconEvent.addEventListener('click', ()=>{
    iconEvent.classList.toggle('bi-arrow-right-circle-fill');
    formEvent.classList.toggle('d-none');
})

let photoBouton = document.getElementById("photo");
let ecoleBouton = document.getElementById("ecole");
let medicalBouton = document.getElementById("medical");
let autreBouton = document.getElementById("autre");

let photo = document.querySelectorAll(".photo");
let ecole = document.querySelectorAll(".ecole");
let medical = document.querySelectorAll(".medical");
let autre = document.querySelectorAll(".autre");

photoBouton.addEventListener('click', ()=>{
    photo.forEach((element) => {
    element.classList.remove ("hide");
    });
    ecole.forEach((element) => {
    element.classList.add ("hide");
    });
    medical.forEach((element) => {
    element.classList.add ("hide");
    });
    autre.forEach((element) => {
    element.classList.add ("hide");
    });
})

ecoleBouton.addEventListener('click', ()=>{
    ecole.forEach((element) => {
    element.classList.remove ("hide");
    });
    photo.forEach((element) => {
    element.classList.add ("hide");
    });
    medical.forEach((element) => {
    element.classList.add ("hide");
    });
    autre.forEach((element) => {
    element.classList.add ("hide");
    });
})

medicalBouton.addEventListener('click', ()=>{
    medical.forEach((element) => {
    element.classList.remove ("hide");
    });
    photo.forEach((element) => {
    element.classList.add ("hide");
    });
    ecole.forEach((element) => {
    element.classList.add ("hide");
    });
    autre.forEach((element) => {
    element.classList.add ("hide");
    });
})

autreBouton.addEventListener('click', ()=>{
    autre.forEach((element) => {
    element.classList.remove ("hide");
    });
    photo.forEach((element) => {
    element.classList.add ("hide");
    });
    ecole.forEach((element) => {
    element.classList.add ("hide");
    });
    medical.forEach((element) => {
    element.classList.add ("hide");
    });
})



