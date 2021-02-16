<main id="inbox">
    <svg viewBox="0 0 1920 47" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="svg-b" d="M-0.000106812 27.9022C294 91.3934 660.5 -28.5801 960 27.9022C1259.5 84.3846 1638 -26.931 1920 27.9022V0H-0.000106812V27.9022Z" fill="#5762D5"/>
    </svg>

    <div id="discussions"></div>

    <?php if (!empty($_GET['discussion'])) : ?>

        <div id="members-container">
            <div id="members"></div>
            <div>
                <div>
                    <div id="new-member"></div>
                    <div class="error"></div>
                </div>
                <button id="add-member" class="add" title="add member"></button>
            </div>
        </div>

        <div id="messages"></div>

        <div id="input">
            <div>
                <div id="message-output"></div>
                <textarea id="message-input"></textarea>
            </div>
            <input type="submit" id="message-send" value="send">
        </div>

        <script>var discussionID = <?= $_GET['discussion'] ?>;var userID = <?= $userID ?>;var discussionCreator = <?= $discussionCreator['creator_id'] ?>;</script>
        <script defer src="assets/js/discussion.js"></script>
        <script defer src="assets/js/members.js"></script>
        <script defer src="assets/js/socket.js"></script>

    <?php endif ?>

    <script defer src="assets/js/discussions.js"></script>
</main>