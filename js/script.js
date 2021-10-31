


/********Menu********/
((d)=> {
 const $btnMenu = d.querySelector(".hamburger");
 const $menu = d.querySelector(".menu");
 const card = d.querySelectorAll(".card-inner")

 $btnMenu.addEventListener("click", e =>{
    $btnMenu.classList.toggle("is-active");
    $menu.classList.toggle("aparece");
});

d.addEventListener("click", e=>{
   
   if (!e.target.matches(".menu a"))return false;
   $btnMenu.classList.toggle("is-active");
   $menu.classList.toggle("aparece");
});

for(const button of card){
    button.addEventListener("mouseenter", e=>{
        button.classList.add("is-flipped");
    })
    button.addEventListener("mouseleave", e=>{
        button.classList.remove("is-flipped");
    })
}


    


})(document);