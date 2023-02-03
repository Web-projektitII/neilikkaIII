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

/*
(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
        form.classList.add('was-validated')
        }, false)
      })
  })()

  */