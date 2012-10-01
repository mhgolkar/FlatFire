/*		  _______________
//		 | 				 |
//		 |	M.H.GOLKAR	 |
//		 |	 FlatFire	 |
//		 |	01.00[2012]	 |
//		 |_______________|
//		 :::	Tree 	:::
*/
function $(id) { 
    if (document.getElementById) 
        var returnVar = document.getElementById(id); 
    else if (document.all) 
        var returnVar = document.all[id]; 
    else if (document.layers) 
        var returnVar = document.layers[id]; 
    return returnVar; 
}

function FF_Display(inta) {
  if($(inta).style.display == "none" ) {
    $(inta).style.display = "";
  }
  else {
    $(inta).style.display = "none";
  }
}