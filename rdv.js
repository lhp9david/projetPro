let medecinBouton = document.querySelector("#medecin");
let annivBouton = document.querySelector("#anniv");
let sportBouton = document.querySelector("#sport");
let scolaireBouton = document.querySelector("#scolaire");
let otherBouton = document.querySelector("#other");

let medecin = document.querySelectorAll(".medecin");
let anniv = document.querySelectorAll(".anniv");
let sport = document.querySelectorAll(".sport");
let scolaire = document.querySelectorAll(".scolaire");
let other = document.querySelectorAll(".other");

medecinBouton.addEventListener('click', ()=>{
    medecin.forEach((element) => {
    element.classList.remove ("hide");
    });
    anniv.forEach((element) => {
    element.classList.add ("hide");
    });
    sport.forEach((element) => {
    element.classList.add ("hide");
    });
    scolaire.forEach((element) => {
    element.classList.add ("hide");
    });
    other.forEach((element) => {
    element.classList.add ("hide");
    });
})

annivBouton.addEventListener('click', ()=>{
    anniv.forEach((element) => {
    element.classList.remove ("hide");
    });
    medecin.forEach((element) => {
    element.classList.add ("hide");
    });
    sport.forEach((element) => {
    element.classList.add ("hide");
    });
    scolaire.forEach((element) => {
    element.classList.add ("hide");
    });
    other.forEach((element) => {
    element.classList.add ("hide");
    });
})

sportBouton.addEventListener('click', ()=>{
    sport.forEach((element) => {
    element.classList.remove ("hide");
    });
    medecin.forEach((element) => {
    element.classList.add ("hide");
    });
    anniv.forEach((element) => {
    element.classList.add ("hide");
    });
    scolaire.forEach((element) => {
    element.classList.add ("hide");
    });
    other.forEach((element) => {
    element.classList.add ("hide");
    });
})

scolaireBouton.addEventListener('click', ()=>{
    scolaire.forEach((element) => {
    element.classList.remove ("hide");
    });
    medecin.forEach((element) => {
    element.classList.add ("hide");
    });
    anniv.forEach((element) => {
    element.classList.add ("hide");
    });
    sport.forEach((element) => {
    element.classList.add ("hide");
    });
    other.forEach((element) => {
    element.classList.add ("hide");
    });
})

otherBouton.addEventListener('click', ()=>{
    other.forEach((element) => {
    element.classList.remove ("hide");
    });
    medecin.forEach((element) => {
    element.classList.add ("hide");
    });
    anniv.forEach((element) => {
    element.classList.add ("hide");
    });
    sport.forEach((element) => {
    element.classList.add ("hide");
    });
    scolaire.forEach((element) => {
    element.classList.add ("hide");
    });
})
