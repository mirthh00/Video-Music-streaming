let selectedimage=document.getElementsById("dislike");
selectedimage.onclick = () =>{
   if(selectedimage.hasAttribute("src"))
   {
    selectedimage.setAttribute("src","images/heart-icon-png-transparent-7.jpg");
    selectedimage.setAttribute("id","like");
   }
}