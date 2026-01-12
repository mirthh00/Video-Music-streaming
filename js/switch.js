
let selectedimage=document.getElementById("like");

selectedimage.onclick = () =>{
        if(selectedimage.hasAttribute("src")){
        selectedimage.setAttribute("src","images/dislike.png");
        selectedimage.setAttribute("id","dislike");
        }
}

