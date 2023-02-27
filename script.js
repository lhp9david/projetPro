// /* ajouter les input pour l'ajout des enfants */

// let addChild = document.querySelector('.addChild');
// addChild.addEventListener('click', function() {

//     let i = document.querySelectorAll('.child').length + 1;


//     let newChild = document.createElement('div');
//     newChild.innerHTML = `             <div class="mb-3">
//     <label for="childFirstname${i}" class="form-label fw-bold fs-5">Prénom</label>
//     <input type="text" class="form-control" id="childFirstname${i}" name="childFirstname" value=""><span class="text-danger"><?= isset($errors['childFirstname']) ? $errors['childFirstname'] : '' ?></span>
// </div>
// <div class="mb-3">
//     <label for="childName${i}" class="form-label fw-bold fs-5">Nom</label>
//     <input type="text" class="form-control" id="childName${i}" name="childName" value=""><span class="text-danger"><?= isset($errors['childName']) ? $errors['childName'] : '' ?></span>
// </div>
// <div class="mb-3">
//     <label for="birthdate${i}" class="form-label fw-bold fs-5">Date de naissance</label>
//     <input type="date" class="form-control" id="birthdate${i}" name="birthdate" value=""><span class="text-danger"><?= isset($errors['birthdate']) ? $errors['birthdate'] : '' ?></span>
// </div>`;
//     document.querySelector('.child').appendChild(newChild);
// })





