const audio = document.getElementById('audio');
const playButton = document.getElementById('play');
const pauseButton = document.getElementById('pause');
const stopButton = document.getElementById('stop');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');
const trackTitle = document.getElementById('track-title');
const volumeControl = document.getElementById('volume');
const progressControl = document.getElementById('progress');
const trackNext = document.getElementById('trackNext');
// Array of songs
const songs = [
    { title: "Dawood - Sidhu Moose Wala", src: "Dawood - Sidhu Moose Wala.mp3" },
    { title: "Hass_Hass", src: "Hass_Hass_1.mp3" },
    { title: "Born_To_Shine_", src: "Born_To_Shine_1.mp3" },
    { title: "G_O_A_T_", src: "G_O_A_T_1.mp3" },
    { title: "5_Taara_", src: "5_Taara_1.mp3" },
    { title: "Putt_Jatt_Da_", src: "Putt_Jatt_Da_1.mp3" },
    { title: "Lalkara", src: "Lalkara.mp3" },
    { title: "Case", src: "Case.mp3" },
    { title: "Mulahjedaariyan", src: "Mulahjedaariyan.mp3" },
];

let currentTrackIndex = 0;

// Load the initial track
loadTrack(currentTrackIndex);

// Function to load a track
function loadTrack(index) {
    audio.src = songs[index].src;
    trackTitle.textContent = songs[index].title;
   if(index===(songs.length)-1){
        n=0;
        trackNext.textContent=songs[n].title;
    }
    else{
    trackNext.textContent=songs[index+1].title;
    }
}

// Play the audio
playButton.addEventListener('click', () => {
    audio.play();
});

// Pause the audio
pauseButton.addEventListener('click', () => {
    audio.pause();
});

// Stop the audio
stopButton.addEventListener('click', () => {
    audio.pause();
    audio.currentTime = 0; // Reset to the beginning
});

// Next track
nextButton.addEventListener('click', () => {
    currentTrackIndex = (currentTrackIndex + 1) % songs.length;
    loadTrack(currentTrackIndex);
    audio.play();
});

// Previous track
prevButton.addEventListener('click', () => {
    currentTrackIndex = (currentTrackIndex - 1 + songs.length) % songs.length;
    loadTrack(currentTrackIndex);
    audio.play();
});
volumeControl.addEventListener('input', (e) => {
    audio.volume = e.target.value; // Set audio volume based on slider value
});
progressControl.addEventListener('input', (e) => {
    const seekTime = (e.target.value / 100) * audio.duration;
    audio.currentTime = seekTime;
});