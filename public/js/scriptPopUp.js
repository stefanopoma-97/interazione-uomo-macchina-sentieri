/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// When the user clicks on div, open the popup
function popup(element) {
  //var popup = document.getElementById("myPopup");
  var pop = element.children[0];
  //window.confirm("first child: "+popup.innerHTML);
  pop.classList.toggle("show");
//   if(pop.classList.contains("show")){
//        clearTimeout(timer);
//        var timer = setTimeout(function() {
//        pop.classList.toggle("show");
//    }, 5000);
//   }
 
//  window.confirm($(element).children().eq(0).text());

}




