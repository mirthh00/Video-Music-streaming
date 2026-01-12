let filechoicebutton=document.getElementById("file");
let selectedimage=document.getElementById("image");

filechoicebutton.onchange = () =>{
    let reader = new FileReader();
    reader.readAsDataURL(filechoicebutton.files[0]);
    console.log(filechoicebutton.files[0]);
    reader.onload = () => {
        selectedimage.setAttribute("src",reader.result);
    }
}