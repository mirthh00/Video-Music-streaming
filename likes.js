const form = document.querySelector(".likearea"),
chatBox = document.querySelector(".likes");
sendBtn = form.querySelector("button");


form.onsubmit = (e)=>{
    e.preventDefault();
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/getlikes.inc.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
          }
      }
    }
}, 100);