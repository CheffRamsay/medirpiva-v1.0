import {headerMenus} from "./headerMenus.js";
import { dropDown } from "./dropDown.js";
import { animation } from "./animation.js";
import { formulario } from "./formulario.js";






/*
//MODAL
let mod = document.querySelector("#modal");

//MODAL
mod.addEventListener("click", ir, false);
function ir(e){
	formulario.scrollIntoView({behavior:"smooth"});
	$( document ).ready(function() {
    $('#myModal').modal('toggle')
    });
	
	
}
*/




const d = document;
d.addEventListener("DOMContentLoaded", e=>{
  headerMenus();
  dropDown();
  animation();
  formulario();
 
});

