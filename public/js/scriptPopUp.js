/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// When the user clicks on div, open the popup
function popup2(element) {
    var pop = element.children[0];
    
    if (pop.classList.contains("show"))
        pop.classList.toggle("show");
    else{
    let popups = document.querySelectorAll(".popuptext");
    //delete popups[popups.indexOf(pop)];
    popups.forEach(function (element) {
      if (element.classList.contains("show")) {
         element.classList.toggle("show");
        }
    });
    pop.classList.toggle("show");
    }
    
  
    
    

}


function popup(element) {
    var pop = element.children[0];
    pop.classList.toggle("show");
}

function close_popup() {
    
    let popups = document.querySelectorAll(".popuptext");
    popups.forEach(function (element) {
      if (element.classList.contains("show")) {
         element.classList.toggle("show");
        }
    });
    
}


