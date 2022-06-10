export function dropDown(){
    const d = document;
    const w = window;
    const barra = d.querySelectorAll(".barra-completa");
    const $dropDown = d.querySelector(".dropdown-menu");
    
    for (let i = 0; i < barra.length; i++) {
        barra[i].addEventListener("click", e =>{
           if(e.target.matches(".btn-link")){
                barra[i].classList.toggle("active");
            }
        })
    }
    
}




  

