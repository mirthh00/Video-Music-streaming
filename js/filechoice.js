let filechoicebutton=document.getElementById("file");
let selectedimage=document.getElementById("image2");
let filechoicebutton2=document.getElementById("file2");
let selectedimage2=document.getElementById("image");
let filechoicebutton3=document.getElementById("file3");
let selectedimage3=document.getElementById("image3");
let filechoicebutton4=document.getElementById("file4");
let selectedimage4=document.getElementById("image4");


filechoicebutton.onchange = () =>{
    let reader = new FileReader();
    reader.readAsDataURL(filechoicebutton.files[0]);
    console.log(filechoicebutton.files[0]);
    reader.onload = () => {
        selectedimage.setAttribute("src",reader.result);
    }
}
filechoicebutton2.onchange = () =>{
    let reader = new FileReader();
    reader.readAsDataURL(filechoicebutton2.files[0]);
    console.log(filechoicebutton2.files[0]);
    reader.onload = () => {
        selectedimage2.setAttribute("src",reader.result);
    }
}

filechoicebutton3.onchange = () =>{
    let reader = new FileReader();
    reader.readAsDataURL(filechoicebutton3.files[0]);
    console.log(filechoicebutton3.files[0]);
    reader.onload = () => {
        selectedimage3.setAttribute("src",reader.result);
    }
}
filechoicebutton4.onchange = () =>{
    let reader = new FileReader();
    reader.readAsDataURL(filechoicebutton4.files[0]);
    console.log(filechoicebutton4.files[0]);
    reader.onload = () => {
        selectedimage4.setAttribute("src",reader.result);
    }
}