const form1 = document.querySelector(".poll-area"),
sendBtn1 = form1.querySelector("button");


form1.onsubmit = (e)=>{
    e.preventDefault();
}

sendBtn1.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/poll.inc.php", true);
    
    let formData1 = new FormData(form1);
    xhr.send(formData1);
}
