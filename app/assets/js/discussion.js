const messageContainer = document.querySelector("#messages");
const messageInput = document.querySelector("#message-input");
const messageSend = document.querySelector("#message-send");
const messageOutput = document.querySelector("#message-output");
const discussionMembers = document.querySelector("#members");

var md = window.markdownit({
    html: true,
    linkify: true,
    typographer: true,
    breaks: true, 
    highlight: function (str, lang) { return '<pre class="hljs"><code>' + hljs.highlight(lang, str).value + '</code></pre>'; }
});

var scrollDown = () => {
    messageContainer.scroll({
        top: messageContainer.scrollHeight,
        left: 0,
    });
}

function imgError(image) {
    image.onerror = "";
    image.src = "/tamanoir.net/app/assets/images/profiles/default.png";
    return true;
}

var fetchDiscussion = (id) => {
    fetch(`api.php?discussion=${id}`)
    .then(response => response.json())
    .then(discussion => {
        messageContainer.innerHTML = '';
        discussion.forEach(message => {
            if (message.author_id == userID) { messageContainer.innerHTML += `<div class="message"><img src="/tamanoir.net/app/assets/images/profiles/${message.username}.png" onerror="imgError(this)" alt="profile picture"><div><p class="username">${message.username}</p><div class="content">${md.render(message.content)}</div></div><div><button onclick="deleteMessage(${message.discussion_id},${message.id})">delete</button><p class="date">${message.date}</p></div></div>`; }
            else { messageContainer.innerHTML += `<div class="message"><img src="/tamanoir.net/app/assets/images/profiles/${message.username}.png" onerror="imgError(this)" alt="profile picture"><div><p class="username">${message.username}</p><div class="content">${md.render(message.content)}</div></div><div><p class="date">${message.date}</p></div></div>`; }
        });
        scrollDown();
    })
}

var deleteMessage = (discussionID,messageID) => {
    fetch(`api.php?discussion=${discussionID}&delete=${messageID}`)
    .then(() => {
        fetchDiscussion(discussionID);
        socket.send(JSON.stringify({request: 'refresh'}));
    })
}

var sendMessage = (value,discussionID) => {
    fetch(`api.php?discussion=${discussionID}&send=` + encodeURIComponent(value))
    .then(() => {
        fetchDiscussion(discussionID);
        socket.send(JSON.stringify({request: 'refresh'}));
    })
}

messageSend.addEventListener("click", () => {
    sendMessage(messageInput.value,discussionID);
    messageOutput.innerHTML = '';
    messageInput.value = '';
})

messageInput.addEventListener('input', () => {
    messageOutput.innerHTML = md.render(messageInput.value);
})

fetchDiscussion(discussionID);
scrollDown();