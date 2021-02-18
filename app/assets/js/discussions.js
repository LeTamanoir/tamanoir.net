const discussionContainer = document.querySelector("#discussions");
const createDiscussion = document.querySelector("#create-discussion");
const newDiscussion = document.querySelector("#new-discussion");
const errorDiscussion = document.querySelector("#discussions-container .error");
var newDiscussionInput;


var deleteDiscussion = (id) => {
    if (confirm("delete discussion ?"))
    {
        fetch(`api.php?discussion=1&delDiscussion=${id}`)
        .then(window.location.href = '?page=Inbox');
    }
} 

var fetchDiscussions = () => {
    fetch('api.php?discussion=all')
    .then(response => response.json())
    .then(discussions => {
        discussionContainer.innerHTML = '';
        discussions.forEach(discussion => {
            if (typeof discussionID !== 'undefined') {
                if (discussion.id == discussionID && discussion.creator_id == userID) { discussionContainer.innerHTML += `<div class="discussion clicked"><a href="?page=Inbox&discussion=${discussion.id}">${discussion.discussion}</a><button onclick="deleteDiscussion(${discussion.id})"></button></div>`; }
                else if (discussion.creator_id == userID) { discussionContainer.innerHTML += `<div class="discussion"><a href="?page=Inbox&discussion=${discussion.id}">${discussion.discussion}</a><button onclick="deleteDiscussion(${discussion.id})"></button></div>`; }
                else if (discussion.id == discussionID) { discussionContainer.innerHTML += `<div class="discussion clicked"><a href="?page=Inbox&discussion=${discussion.id}">${discussion.discussion}</a></div>`; }
                else { discussionContainer.innerHTML += `<div class="discussion"><a href="?page=Inbox&discussion=${discussion.id}">${discussion.discussion}</a></div>`; }
            }
            else { discussionContainer.innerHTML += `<div class="discussion"><a href="?page=Inbox&discussion=${discussion.id}">${discussion.discussion}</a></div>`; }
        });
    });
}

fetchDiscussions()

createDiscussion.addEventListener("click", () => {
    if (newDiscussion.innerHTML == "") {
        newDiscussion.innerHTML = `<input type=text id="new-discussion-input" placeholder="discussion name">`;
        createDiscussion.classList.replace("add","reject");
        newDiscussionInput = document.querySelector("#new-discussion-input");
    }
    else if (newDiscussionInput.value.length == 0) {
        newDiscussion.innerHTML = '';
        errorDiscussion.innerHTML = '';
        createDiscussion.classList.replace("reject","add");

    }
    else if (newDiscussionInput.value.length > 0) {
        fetch(`api.php?discussion=1&createDiscussion=${newDiscussionInput.value}`)
        .then(res => res.json())
        .then(res => {
            if (res.info == "success") {
                fetchDiscussions()
                newDiscussionInput.value = '';
                newDiscussion.innerHTML = '';
                errorDiscussion.innerHTML = '';
                createDiscussion.classList.replace("confirm","add");
            }
            else {
                errorDiscussion.innerHTML = res.info;
            }
        });
    }
    newDiscussionInput.addEventListener("input", () => {
        if (newDiscussionInput.value.length > 0) {
            createDiscussion.classList.replace("reject","confirm");
        } else {
            createDiscussion.classList.replace("confirm","reject");
        }
    })
})