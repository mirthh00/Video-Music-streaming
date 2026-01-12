
const button5=document.getElementById("commenticon");
const reply5=document.getElementById("commentbox");
reply5.style.display="none";
button5.addEventListener("click",(event)=>{
if(reply5.style.display=="none"){
    reply5.style.display="block";  
}
else{
    reply5.style.display="none";  
}
})
const button3=document.getElementById("replybutton");
const reply=document.getElementById("reply");
reply.style.display="none";
button3.addEventListener("click",(event)=>{
    if(reply.style.display=="none"){
        reply.style.display="block";  
    }
    else{
        reply.style.display="none";  
    }
})
const button4=document.getElementById("viewbutton");
const view=document.getElementById("view");
view.style.display="none";
button4.addEventListener("click",(event)=>{
    if(view.style.display=="none"){
        view.style.display="block";  
    }
    else{
        view.style.display="none";  
    }
})


