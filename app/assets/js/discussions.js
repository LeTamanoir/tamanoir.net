const discussionContainer = document.querySelector("#discussions");
const messageContainer = document.querySelector("#messages");
const messageInput = document.querySelector("#message-input");
const messageSend = document.querySelector("#message-send");

var fetchDiscussions = () => {
    fetch('api.php?discussion=all')
    .then(response => response.json())
    .then(discussions => {
        discussions.forEach(discussion => {
            console.log(discussion);
            discussionContainer.innerHTML += `
            <div class="discussion">
                <a href="?page=Inbox&discussion=${discussion.id}">${discussion.discussion}</a>
            </div>
            `;
        });
    });
}

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
            if (message.author_id == userID) { messageContainer.innerHTML += `<div class="message"><img src="/tamanoir.net/app/assets/images/profiles/${message.username}.png" onerror="imgError(this)" alt="profile picture"><div><p class="username">${message.username}</p><p class="content">${message.content}</p></div><div><p class="date">${message.date}</p><button onclick="deleteMessage(${message.discussion_id},${message.id})">delete</button></div></div>`; }
            else { messageContainer.innerHTML += `<div class="message"><img src="/tamanoir.net/app/assets/images/profiles/${message.username}.png" onerror="imgError(this)" alt="profile picture"><div><p class="username">${message.username}</p><p class="content">${message.content}</p></div><div><p class="date">${message.date}</p></div></div>`; }
        });
        scrollDown()
    })
}

var deleteMessage = (discussionID,messageID) => {
    fetch(`api.php?discussion=${discussionID}&delete=${messageID}`)
    .then(fetchDiscussion(discussionID))

}

var sendMessage = (value,discussionID) => {
    console.log(discussionID)
    fetch(`api.php?discussion=${discussionID}&send=${value}`)
    .then(fetchDiscussion(discussionID))
}

messageInput.addEventListener("keyup", function(e) {
    if (e.keyCode === 13) {
        sendMessage(messageInput.value,discussionID);
        messageInput.value = '';
    }
});
messageSend.addEventListener("click", () => {
    sendMessage(messageInput.value,discussionID);
    messageInput.value = '';
})

scrollDown()