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
console.log("let",formData)   
return false
}    