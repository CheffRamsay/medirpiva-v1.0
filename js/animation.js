export function  animation() {


    const d = document;
    const w = window;
    const sectionsToAnimate = d.querySelectorAll(".anim");
    const $titulo = d.querySelector(".titulo");
    const $loader = d.querySelector("#loader-wrapper");
    const $elipse = d.querySelector(".elipse");
    const $familiaImg = d.querySelector(".familiaSlider");
    const $rectanguloDialog = d.querySelector(".recta");

    const cb = (entries) =>{
      entries.forEach(entry =>{
          //console.log(entries)
          if(entry.isIntersecting){
            entry.target.classList.add("fadeInUp");
          }
      })
    }

    //Recibe una callback y una serie de opciones 
    const observer = new IntersectionObserver(cb, {

    });
    //A cada section le agregamos atributo observe
    sectionsToAnimate.forEach(el => observer.observe(el));
    
    w.addEventListener('load', e =>{
      $loader.parentElement.removeChild($loader);
      $elipse.classList.add("fadeInUp");
      $familiaImg.classList.add("fadeInUp1");
      $rectanguloDialog.classList.add("fadeInUp2");
    });
}