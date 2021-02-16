const discussionContainer = document.querySelector("#discussions");

var fetchDiscussions = () => {
    fetch('api.php?discussion=all')
    .then(response => response.json())
    .then(discussions => {
        discussions.forEach(discussion => {
            if (typeof discussionID !== 'undefined') {
                if (discussion.id == discussionID) { discussionContainer.innerHTML += `<div class="discussion"><a class="clicked" href="?page=Inbox&discussion=${discussion.id}">${discussion.discussion}</a></div>`; }
                else { discussionContainer.innerHTML += `<div class="discussion"><a href="?page=Inbox&discussion=${discussion.id}">${discussion.discussion}</a></div>`; }
            }
            else { discussionContainer.innerHTML += `<div class="discussion"><a href="?page=Inbox&discussion=${discussion.id}">${discussion.discussion}</a></div>`; }
        });
    });
}

fetchDiscussions()