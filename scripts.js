/* Bootstrap 5:

HTML form validation is applied via CSS’s two pseudo-classes, :invalid and :valid. 
It applies to <input>, <select>, and <textarea> elements.

Bootstrap scopes the :invalid and :valid styles to parent .was-validated class, 
usually applied to the <form>. 

Otherwise, any required field without a value shows up as invalid on page load. 
This way, you may choose when to activate them (typically after form submission 
is attempted). To reset the appearance of the form (for instance, in the case 
of dynamic form submissions using AJAX), remove the .was-validated class from 
the <form> again after submission. 

As a fallback, .is-invalid and .is-valid classes may be used instead of the 
pseudo-classes for server-side validation. They do not require a .was-validated 
parent class.
*/

const menutoggle = () => {
    var x = document.querySelector("#myTopnav");
    if (x.className === "topnav") x.className += " responsive"; 
    else x.className = "topnav";
    }


const tallennus = e => {
console.log(e.target)    
//let form = e.target    
e.preventDefault();  
let form = e.target  
let formData = new FormData(form)
formData.append('painike', 'Lähetä');
console.log("let",formData)   
fetch("yhteydenotto.php",{
    method:"POST",
    body: formData    
    })
.then(response => response.json()) 
.then(result => {
    document.querySelector("#tulos").innerHTML = JSON.stringify(result)
    console.log("result:",JSON.stringify(result))
    }) 
.catch(error => console.log(error)) 
return false
}

const poista_is_invalid = event => {
  let element = event.target;
  /*document.querySelectorAll("input[type='radio']").forEach(radio => {
        if (radio.classList.contains('is-invalid')) {     
          radio.classList.remove("is-invalid");    
          radio.removeEventListener("input", poista_is_invalid);     
          } 
        }) */
  if (element.classList.contains('is-invalid')){
    element.classList.remove("is-invalid");    
    element.removeEventListener("input", poista_is_invalid);
    }
  console.log("sisältääkö "+element.name+" is_invalid-luokan: ",element.classList.contains('is-invalid'))
  }    

const tarkista_salasana = () => {
  let password = document.querySelector("#password");
  let confirm_password = document.querySelector("#confirm_password");
  if (password.value != confirm_password.value){
     confirm_password.setCustomValidity('Salasanat eivät täsmää.')
     }
  else {
    confirm_password.setCustomValidity('')
    }  
  }



(() => {
  'use strict'
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  
  /*
  password.onchange = tarkista_salasana;
  confirm_password.onchange = tarkista_salasana;  
  */

  document.querySelectorAll(".is-invalid").forEach(
    element => element.addEventListener("input", poista_is_invalid)
    ) 
  
  const forms = document.querySelectorAll('.needs-validation')
  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
  })()   
