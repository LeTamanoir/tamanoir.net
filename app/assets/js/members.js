const newMember = document.querySelector("#new-member");
const addMember = document.querySelector("#add-member");
const errorUser = document.querySelector("#members-container .error");
var newUser;

addMember.addEventListener("click", () => {
    if (newMember.innerHTML == "") {
        newMember.innerHTML = `<input type=text id="new-user">`;
        addMember.classList.replace("add","reject");
        newUser = document.querySelector("#new-user");
    }
    else if (newUser.value.length == 0) {
        newMember.innerHTML = '';
        errorUser.innerHTML = '';
        addMember.classList.replace("reject","add");

    }
    else if (newUser.value.length > 0) {
        fetch(`api.php?discussion=${discussionID}&addMember=${newUser.value}`)
        .then(res => res.json())
        .then(res => {
            if (res.info == "success") {
                fetchMembers(discussionID);
                newUser.value = '';
                newMember.innerHTML = '';
                errorUser.innerHTML = '';
                addMember.classList.replace("confirm","add");
            }
            else {
                errorUser.innerHTML = res.info;
            }
        });
    }
    newUser.addEventListener("input", () => {
        if (newUser.value.length > 0) {
            addMember.classList.replace("reject","confirm");
        } else {
            addMember.classList.replace("confirm","reject");
        }
    })
})

var deleteMember = (id) => {
    fetch(`api.php?discussion=${discussionID}&delMember=${id}`)
    .then(fetchMembers(discussionID));
}

var fetchMembers = (id) => {
    fetch(`api.php?discussion=${id}&members=all`)
    .then(response => response.json())
    .then(members => {
        discussionMembers.innerHTML = '';
        members.forEach(member => {
            console.log(member)
            if (userID == discussionCreator) { discussionMembers.innerHTML += `<div class="member"><p>${member.username}</p><button onclick="deleteMember(${member.id})"></button></div>`; }
            else { discussionMembers.innerHTML += `<div class="member"><p>${member.username}</p></div>`; }
        });
        scrollDown();
    })
}

fetchMembers(discussionID);