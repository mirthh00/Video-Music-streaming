var today= new Date();
var hour = today.getHours();
var greeting;

if (hour >= 18){
    greeting="Good Evening "
}

else if (hour >= 12){
    greeting="Good Afternoon "
}

else if (hour>=0){
    greeting="Good Morning "
}

document.write('<h1>'+greeting+'</h1>')