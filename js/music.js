//create array of songs

const music = new Audio('none');

const songs=[
    {
        id:'1',
        songName:'Bad Bunny-Light The Streets feat J Balvin',
        artistName:'Bad Bunny | J Balvin',
        poster:'images/1.jpg',
        uploader:'images/2.jpg'
    },

    {
        id:'2',
        songName:'Bad Company-Txa Ma Bad',
        artistName:'Bad Company',
        poster:'images/2.jpg',
        uploader:'images/1.jpg'
    },
    
    {
        id:'3',
        songName:'Ngikhulile',
        artistName:'Light Dee',
        poster:'images/3.jpg',
        uploader:'images/4.jpg'
    },

    {
        id:'4',
        songName:'Uthando Lwakho',
        artistName:'Lowsheen | MasterKG | Basetsana',
        poster:'images/4.jpg',
        uploader:'images/3.jpg'
    },

    {
        id:'5',
        songName:'Despacito',
        artistName:'Luis Fonsi | Daddy Yanke',
        poster:'images/5.jpg',
        uploader:'images/6.jpg'
    },

    {
        id:'6',
        songName:'Jerusalema',
        artistName:'MasterKG | Nomcebo Zikode',
        poster:'images/6.jpg',
        uploader:'images/5.jpg'
    }
]

Array.from(document.getElementsByClassName('video')).forEach((element, i)=>{
    element.getElementsByTagName('img')[0].src=songs[i].poster;
    element.getElementsByClassName('account')[0].src=songs[i].uploader;
    element.getElementsByTagName('p')[0].innerHTML=songs[i].songName;
    element.getElementsByClassName('artistsnames')[0].innerHTML=songs[i].artistName;
})
let poster_master_player = document.getElementById('poster_master_play');
let masterPlay = document.getElementById('masterPlay');
masterPlay.addEventListener('click',()=>{
    if(music.paused || music.currentTime <= 0)
    {
        music.play();
        masterPlay.classList.remove('fa-play');
        masterPlay.classList.add('fa-pause');
        poster_master_player.style.animation='spin 1s linear infinite';
    }
    else{
        music.pause();
        masterPlay.classList.remove('fa-pause');
        masterPlay.classList.add('fa-play');
        poster_master_player.style.animation='none';
        
    }
})

let index=0;

let title = document.getElementById('title');
let artist = document.getElementById('artist');

const makeallplays = () =>{
    Array.from(document.getElementsByClassName('songplay')).forEach((element)=>{
        element.classList.add('fa-circle-play');
        element.classList.remove('fa-pause');  
      
    })
}

Array.from(document.getElementsByClassName('songplay')).forEach((element)=>{
    element.addEventListener('click', (e)=>{
        index=e.target.id;
        makeallplays();
        e.target.classList.remove('fa-circle-play');
        e.target.classList.add('fa-pause');
        music.src = `music/${index}.mp3`;
        poster_master_player.style.display='block';
        poster_master_player.src = `images/${index}.jpg`;
        masterPlay.classList.remove('fa-play');
        masterPlay.classList.add('fa-pause');
        poster_master_player.style.animation='spin 1s linear infinite';
        music.play();
        let song_title = songs.filter((ele)=>{
            return ele.id == index;
        })

        song_title.forEach(ele =>{
            let {songName} = ele;
            title.innerHTML = songName;
        })

        let artist_title = songs.filter((ele1)=>{
            return ele1.id == index;
        })
    
        artist_title.forEach(ele1 =>{
            let {artistName} = ele1;
            artist.innerHTML = artistName;
        })
    })
})

let currentStart = document.getElementById('currentstart');
let currentEnd = document.getElementById('currentend');
let seek = document.getElementById('seek');
let bar2 = document.getElementById('bar2');
let dot = document.getElementById('dot');
music.addEventListener('timeupdate',()=>{
    let music_curr = music.currentTime;
    let music_dur = music.duration;
    let min = Math.floor(music_dur/60);
    let sec = Math.floor(music_dur%60);
    if (sec<10) {
        sec = `0${sec}`;
    }

    let min1 = Math.floor(music_curr/60);
    let sec1 = Math.floor(music_curr%60);
    if (sec1<10) {
        sec1 = `0${sec1}`;
    }
   
    currentEnd.innerHTML = `${min}:${sec}`;
    currentStart.innerHTML = `${min1}:${sec1}/`;

    if (currentStart==currentEnd) {
        poster_master_player.style.animation='spin 1s linear infinite';
        music.play();
    }
    
    let progressbar = parseInt((music.currentTime/music.duration)*100);
    seek.value = progressbar;
    let seekbar = seek.value;
    bar2.style.width = `${seekbar}%`;
    dot.style.left = `${seekbar}%`;
})

seek.addEventListener('change',()=>{
    music.currentTime = seek.value * music.duration/100;
})

let repeat = document.getElementById("repeat");

repeat.addEventListener('click',()=>{
    if (repeat.classList=='bi bi-repeat') {
        repeat.classList.remove('bi-repeat');
        repeat.classList.add('bi-repeat-1');
    }
    else{
        repeat.classList.remove('bi-repeat-1');
        repeat.classList.add('bi-repeat');
       
    }
   
})

music.addEventListener('ended',()=>{
    
    if (repeat.classList=='bi bi-repeat-1') {
        music.src = `music/${index}.mp3`;
        poster_master_player.style.display='block';
        poster_master_player.src = `images/${index}.jpg`;
        poster_master_player.style.animation='spin 1s linear infinite';
        music.play();
        let song_title = songs.filter((ele)=>{
            return ele.id == index;
        })
    
        song_title.forEach(ele =>{
            let {songName} = ele;
            title.innerHTML = songName;
        })
    
        let artist_title = songs.filter((ele1)=>{
            return ele1.id == index;
        })
    
        artist_title.forEach(ele1 =>{
            let {artistName} = ele1;
            artist.innerHTML = artistName;
        })
        makeallplays();
        document.getElementById(`${index}`).classList.remove('fa-circle-play');
        document.getElementById(`${index}`).classList.add('fa-pause');
    }

    else{
        index-=0;
        index+=1;
        if (index > Array.from(document.getElementsByClassName('songplay')).length) {
            index = 1;
        }
        music.src = `music/${index}.mp3`;
        poster_master_player.style.display='block';
        poster_master_player.src = `images/${index}.jpg`;
        poster_master_player.style.animation='spin 1s linear infinite';
        music.play();
        let song_title = songs.filter((ele)=>{
            return ele.id == index;
        })
    
        song_title.forEach(ele =>{
            let {songName} = ele;
            title.innerHTML = songName;
        })
    
        let artist_title = songs.filter((ele1)=>{
            return ele1.id == index;
        })
    
        artist_title.forEach(ele1 =>{
            let {artistName} = ele1;
            artist.innerHTML = artistName;
        })
        makeallplays();
        document.getElementById(`${index}`).classList.remove('fa-circle-play');
        document.getElementById(`${index}`).classList.add('fa-pause');
    }

 
})

let volumeicon=document.getElementById('volumeicon');
let volumebar=document.getElementById('volumebar');
let volumebar2=document.getElementById('volumebar2');
let volumedot=document.getElementById('volumedot');
volumebar.addEventListener('change',()=>{
   if (volumebar.value==0) {
        volumeicon.classList.remove('fa-volume-low');
        volumeicon.classList.remove('fa-volume-high');
        volumeicon.classList.add('fa-volume-xmark');
   }

   if (volumebar.value>0) {
    volumeicon.classList.add('fa-volume-low');
    volumeicon.classList.remove('fa-volume-high');
    volumeicon.classList.remove('fa-volume-xmark');
}

if (volumebar.value>50) {
    volumeicon.classList.remove('fa-volume-low');
    volumeicon.classList.add('fa-volume-high');
    volumeicon.classList.remove('fa-volume-xmark');
}

let vol_a = volumebar.value;
volumebar2.style.width = `${vol_a}%`;
volumedot.style.left = `${vol_a}%`;
music.volume=vol_a/100;
})

let back = document.getElementById('back');
let next = document.getElementById('next');

back.addEventListener('click',()=>{
    index-=1;
    if (index < 1) {
        index = Array.from(document.getElementsByClassName('songplay')).length;
    }
    music.src = `music/${index}.mp3`;
    poster_master_player.style.display='block';
    poster_master_player.src = `images/${index}.jpg`;
    poster_master_player.style.animation='spin 1s linear infinite';
    music.play();
    let song_title = songs.filter((ele)=>{
        return ele.id == index;
    })

    song_title.forEach(ele =>{
        let {songName} = ele;
        title.innerHTML = songName;
    })

    let artist_title = songs.filter((ele1)=>{
        return ele1.id == index;
    })

    artist_title.forEach(ele1 =>{
        let {artistName} = ele1;
        artist.innerHTML = artistName;
    })
    makeallplays();
    document.getElementById(`${index}`).classList.remove('fa-circle-play');
    document.getElementById(`${index}`).classList.add('fa-pause');
})

next.addEventListener('click',()=>{
    index-=0;
    index+=1;
    if (index > Array.from(document.getElementsByClassName('songplay')).length) {
        index = 1;
    }
    poster_master_player.style.display='block';
    music.src = `music/${index}.mp3`;
    poster_master_player.src = `images/${index}.jpg`;
    poster_master_player.style.animation='spin 1s linear infinite';
    music.play();
    let song_title = songs.filter((ele)=>{
        return ele.id == index;
    })

    song_title.forEach(ele =>{
        let {songName} = ele;
        title.innerHTML = songName;
    })

    let artist_title = songs.filter((ele1)=>{
        return ele1.id == index;
    })

    artist_title.forEach(ele1 =>{
        let {artistName} = ele1;
        artist.innerHTML = artistName;
    })
    makeallplays();
    document.getElementById(`${index}`).classList.remove('fa-circle-play');
    document.getElementById(`${index}`).classList.add('fa-pause');
})

Array.from(document.getElementsByClassName('react')).forEach((element)=>{
    element.addEventListener('click', (e)=>{
        index=e.target.id;
        if (e.target.classList=='bi react bi-heart') {
            e.target.classList.remove('bi-heart');
            e.target.classList.add('bi-heart-fill');
        }
        else{
            e.target.classList.remove('bi-heart-fill');
            e.target.classList.add('bi-heart'); 
        }
        
    })
})

var icon=document.getElementById("theme-icon");
icon.onclick = function(){
document.body.classList.toggle("white-theme");
                   
}