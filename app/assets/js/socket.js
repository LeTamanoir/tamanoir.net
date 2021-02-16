const socket = new WebSocket('wss://www.tamanoir.net/api/socket');

socket.onopen =  function () {
    console.log('%cConnected to WS Server ✅', 'font-weight: bold; color: green;');
    socket.send(JSON.stringify({request: 'initialise', discussion: discussionID}));
};

socket.onmessage = function(msg) {
    msg = JSON.parse(msg.data);
    if (msg.info) {
        console.log(msg.info);
    }
    if (msg.request) {
        if (msg.request == "refresh") {
            fetchDiscussion(discussionID);
        }
    }
};