<main id="inbox">

    <div id="discussions-container">
        <div id="discussions"></div>
        <div id="new-discussion"></div>
        <div class="error"></div>
        <button id="create-discussion" class="add" title="add discussion"></button>
    </div>

    <?php if (!empty($_GET['discussion'])) : ?>

        <div id="members-container">
            <div id="members"></div>
            <div id="new-member"></div>
            <div class="error"></div>
            <button id="add-member" class="add" title="add member"></button>
        </div>

        <div id="discussion-container">
            <div id="messages"></div>
            <div id="input">
                <div>
                    <div id="message-output"></div>
                    <textarea id="message-input"></textarea>
                </div>
                <input type="submit" id="message-send" value="send">
            </div>
        </div>

        <script>var discussionID = <?= $_GET['discussion'] ?>;var discussionCreator = <?= $discussionCreator['creator_id'] ?>;var userID = <?= $userID ?>;</script>
        <script defer src="assets/js/discussion.js"></script>
        <script defer src="assets/js/members.js"></script>
        <script defer src="assets/js/socket.js"></script>

    <?php endif ?>

    <script>var userID = <?= $userID ?>;</script>
    <script defer src="assets/js/discussions.js"></script>
    
</main>