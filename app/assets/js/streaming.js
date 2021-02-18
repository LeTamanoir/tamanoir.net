var videoSource = document.querySelector('video>source');
var video = document.querySelector('video');
var select = document.querySelector('select');
var watchEpisode = () => {
    episode = select.value;
    videoSource.src = `api.php?show=${show}&season=S${season}&episode=E${episode}`;
    video.load();
    video.play();
}
window.addEventListener('beforeunload', () => {
    videoSource.src = '';
    video.load();
});