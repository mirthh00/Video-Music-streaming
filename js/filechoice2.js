
let filechoicebutton2=document.getElementById("file2");
let selectedimage2=document.getElementById("image");

filechoicebutton2.onchange = () =>{
    let reader = new FileReader();
    reader.readAsDataURL(filechoicebutton2.files[0]);
    console.log(filechoicebutton2.files[0]);
    reader.onload = () => {
        selectedimage2.setAttribute("src",reader.result);
    }
}

