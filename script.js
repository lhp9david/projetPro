// let addChild = document.querySelector('.addChild');
// addChild.addEventListener('click', function() {




//     let newChild = document.createElement('div');
//     newChild.innerHTML = `             <div class="mb-3">
//     <label for="childFirstname" class="form-label fw-bold fs-5">Prénom</label>
//     <input type="text" class="form-control" id="childFirstname" name="childFirstname${i}" value=""><span class="text-danger"><?= isset($errors['childFirstname']) ? $errors['childFirstname'] : '' ?></span>
// </div>
// <div class="mb-3">
//     <label for="childName" class="form-label fw-bold fs-5">Nom</label>
//     <input type="text" class="form-control" id="childName" name="childName" value=""><span class="text-danger"><?= isset($errors['childName']) ? $errors['childName'] : '' ?></span>
// </div>
// <div class="mb-3">
//     <label for="birthdate" class="form-label fw-bold fs-5">Date de naissance</label>
//     <input type="date" class="form-control" id="birthdate" name="birthdate" value=""><span class="text-danger"><?= isset($errors['birthdate']) ? $errors['birthdate'] : '' ?></span>
// </div>`;
//     document.querySelector('.child').appendChild(newChild);
// })



eventContainer = document.querySelectorAll('.event-container1');

console.log(eventContainer);

if (eventContainer.length < 1 ) {
    let newEvent = document.createElement('div');
    newEvent.innerText = 'Aucun événement à venir';
    document.querySelector('.event-container').appendChild(newEvent);

}


// function afficherEnPleinEcran(element) {
//     if (!document.fullscreenElement) {
//       if (element.requestFullscreen) {
//         element.requestFullscreen();
//       } else if (element.webkitRequestFullscreen) { /* Safari */
//         element.webkitRequestFullscreen();
//       } else if (element.msRequestFullscreen) { /* IE11 */
//         element.msRequestFullscreen();
//       }
//     } else {
//       if (document.exitFullscreen) {
//         document.exitFullscreen();
//       } else if (document.webkitExitFullscreen) { /* Safari */
//         document.webkitExitFullscreen();
//       } else if (document.msExitFullscreen) { /* IE11 */
//         document.msExitFullscreen();
//       }
//     }
//   }
// document.addEventListener('DOMContentLoaded', () => {
//     const elt = document.querySelectorAll('.elt');
// elt.forEach(element => {
//     element.addEventListener('click', () => {
//        afficherEnPleinEcran(element);
//     })
    
// });
// });


