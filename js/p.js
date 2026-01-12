const playPauseBtn = document.querySelector(".play-pause-btn")
const videoContainer = document.querySelector(".video-container")
const miniPlayerBtn = document.querySelector(".miniplayer-btn")
const video = document.querySelector("video")
const currentTimeElem = document.querySelector(".current-time")
const totalTimeElem = document.querySelector(".total-time")
const backward = document.querySelector(".backward-btn")
const forward = document.querySelector(".forward-btn")
const caption = document.querySelector(".caption-btn")
const timelineContainer = document.querySelector(".timeline-container")
const fullScreenBtn = document.querySelector(".fullscreen-btn")
const suggest = document.querySelector(".suggest")


//play/pause video


playPauseBtn.addEventListener('click',togglePlay)
function togglePlay(){
    video.paused ? video.play():video.pause()
}
video.addEventListener('play', () => {
    videoContainer.classList.remove('paused')
    suggest.classList.remove("display")
})
video.addEventListener('pause', () => {
    videoContainer.classList.add('paused')
    suggest.classList.remove("display")
})
video.addEventListener('enterpictureinpicture', () => {
    videoContainer.classList.add('mini-player')
})
video.addEventListener('leavepictureinpicture', () => {
    videoContainer.classList.remove('mini-player')
})

// Timeline
timelineContainer.addEventListener("mousemove", handleTimelineUpdate)
timelineContainer.addEventListener("mousedown", toggleScrubbing)
document.addEventListener("mouseup", e => {
  if (isScrubbing) toggleScrubbing(e)
})
document.addEventListener("mousemove", e => {
  if (isScrubbing) handleTimelineUpdate(e)
})

let isScrubbing = false
let wasPaused
function toggleScrubbing(e) {
  const rect = timelineContainer.getBoundingClientRect()
  const percent = Math.min(Math.max(0, e.x - rect.x), rect.width) / rect.width
  isScrubbing = (e.buttons & 1) === 1
  videoContainer.classList.toggle("scrubbing", isScrubbing)
  if (isScrubbing) {
    wasPaused = video.paused
    video.pause()
  } else {
    video.currentTime = percent * video.duration
    if (!wasPaused) video.play()
  }

  handleTimelineUpdate(e)
}

function handleTimelineUpdate(e) {
  const rect = timelineContainer.getBoundingClientRect()
  const percent = Math.min(Math.max(0, e.x - rect.x), rect.width) / rect.width
  const previewImgNumber = Math.max(
    1,
    Math.floor((percent * video.duration) / 10)
  )
 
  timelineContainer.style.setProperty("--preview-position", percent)

  if (isScrubbing) {
    e.preventDefault()
    timelineContainer.style.setProperty("--progress-position", percent)
  }
}

//captions



//time

video.addEventListener('loadeddata',() => {
    totalTimeElem.textContent = formatDuration(video.duration)
})
const leadingzeroformatter=new Intl.NumberFormat(undefined,{
    minimumIntegerDigits:2,
})
function formatDuration(time){
    const seconds = Math.floor(time%60)
    const minutes = Math.floor(time/60)%60
    const hours = Math.floor(time/3600)

    if(hours===0){
        return `${minutes}:${leadingzeroformatter.format(seconds)}`
    }
    else{
        return `${hours}:${leadingzeroformatter.format(minutes)}:${leadingzeroformatter.format(seconds)}`
    }

}

video.addEventListener('timeupdate',() => {
    
    const percent = video.currentTime / video.duration
    timelineContainer.style.setProperty("--progress-position", percent)
    const remainingTime = Math.floor(video.duration-video.currentTime)
    currentTimeElem.textContent = formatDuration(video.currentTime)
    if(remainingTime < 13){
        suggest.classList.add("display")
    }
    else if(remainingTime != Math.floor(video.duration)){
        suggest.classList.remove("display")
    }
    totalTimeElem.textContent = formatDuration(video.duration)
})
video.addEventListener('ended',() =>{
    suggest.classList.add("display");
})
video.addEventListener('playing',() =>{
    suggest.classList.remove("display")
})
//skip
backward.addEventListener('click',() => {
    toggleSkip(-10)
})

forward.addEventListener('click',() => {
    toggleSkip(10)
})

function toggleSkip(duration){
    video.currentTime+=duration
}

//display
miniPlayerBtn.addEventListener('click',toggleMiniPlayerMode)

function toggleMiniPlayerMode(){
    if(videoContainer.classList.contains("mini-player")){
        document.exitPictureInPicture()
    }
    else{
        video.requestPictureInPicture()
    }
}

fullScreenBtn.addEventListener('click',toggleFullScrenMode)

function toggleFullScrenMode(){
    if(document.fullscreenElement==null){
        videoContainer.requestFullscreen()
        suggest.classList.remove("display")
    }
    else{
        document.exitFullscreen()
        suggest.classList.add("display")
    }
}
document.addEventListener('fullscreenchange', () => {
    videoContainer.classList.toggle("full-screen",document.fullscreenElement)
    
})

//volume

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
video.volume=vol_a/100;
})


const captions = video.textTracks[0]
captions.mode="hidden"
caption.addEventListener('click',toggleCaption)

function toggleCaption(){
    const isHidden = captions.mode === "hidden"
    captions.mode = isHidden ? "showing" : "hidden"
    videoContainer.classList.toggle("captions",isHidden)
}

window.addEventListener('contextmenu', function(e) {e.stopPropagation();e.preventDefault();}, true);




