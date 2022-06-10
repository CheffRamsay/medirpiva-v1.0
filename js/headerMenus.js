export function headerMenus(){
    const d = document;
    const w = window;
    const containerMenu = d.querySelector(".menu-container");

    const ClickEnlaceCerrarMenu = el =>{
        if(el.target.matches(".menu-enlace")){
            containerMenu.classList.add("menu-cerrado");
        }
    }

    const MenuAbierto = e =>{
        containerMenu.classList.add("menu-abierto");
        containerMenu.classList.remove("menu-cerrado");
    }

    const MenuCerrado = e =>{
        containerMenu.classList.add("menu-cerrado");
        containerMenu.classList.remove("menu-abierto");
    }
    
    
    d.addEventListener("click", (e)=>{
        if(e.target.matches(".hambur")){
           MenuAbierto();
        }

        if(e.target.matches(".cruz")){
           MenuCerrado();
        }
        
        if(screen.width <= 950){
           ClickEnlaceCerrarMenu(e); 
        }
    });

    w.addEventListener("resize", (e)=>{
        if(screen.width <= 1000){
            containerMenu.classList.add("menu-cerrado");
          
        }else{
            containerMenu.classList.remove("menu-cerrado"); 
            containerMenu.classList.remove("menu-abierto");
        }
    });
    
    /*Efecto scroll menu
    
     const menu = d.querySelector(".menu-container");
    const topMenu = menu.offsetTop;

    const fixNav = e =>{
        if(w.scrollY >= topMenu && screen.width > 950){
            d.body.style.paddingTop = menu.offsetHeight + "px";
            d.body.classList.add("sticky");
        }else{
            d.body.style.paddingTop = 0;
            d.body.classList.remove("sticky");
        } 
  
       
    }
    
    
    
    
    */
   
 
   // w.addEventListener("scroll", fixNav);

}