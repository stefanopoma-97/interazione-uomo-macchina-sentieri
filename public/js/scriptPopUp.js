/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// When the user clicks on div, open the popup
function popup(element) {
  let popups = document.querySelectorAll(".popuptext");
    popups.forEach(function (element) {
      if (element.classList.contains("show")) {
         element.classList.toggle("show");
        }
    });
  var pop = element.children[0];
  pop.classList.toggle("show");


}


function popup2(element) {
  element.stopPropagation(); 
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


