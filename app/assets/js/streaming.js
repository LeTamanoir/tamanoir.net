var videoSource = document.querySelector('video>source');
var video = document.querySelector('video');
var select = document.querySelector('select');

if (typeof(resume) != 'undefined') {
    videoSource.src = resume;
    video.load();
    video.currentTime = time;
    fetch(`api.php?show=${show}&season=${season}&episode=${episode}&action=delete`)
}

var watchEpisode = () => {
    episode = select.value;
    videoSource.src = `api.php?show=${show}&season=S${season}&episode=E${episode}&action=watch`;
    video.load();
    video.play();
}

window.onbeforeunload = () => {
    time = Math.round(video.currentTime);
    fetch(`api.php?show=${show}&season=${season}&episode=${episode}&time=${time}&action=save`)
    videoSource.src = '';
    video.load();
};