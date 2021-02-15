<main id="inbox">
    <svg viewBox="0 0 1920 114" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="svg-b" d="M0.00012207 67.6779C294 221.678 660.5 -69.3221 960 67.6779C1259.5 204.678 1638 -65.3221 1920 67.6779V0H0.00012207V67.6779Z"/>
    </svg>
    <div id="discussions">
        <?php if ($discussions) : ?>
            <?php foreach ($discussions as $discussion) : ?>
                <div class="discussion">
                    <a class="<?php if ($_GET['discussion'] === $discussion['id']) { echo "clicked"; } ?>" href="?page=Inbox&discussion=<?= $discussion['id'] ?>"><?= $discussion['discussion'] ?></a>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <div id="messages">
        <?php if (isset($messages)) : ?>
            <?php foreach ($messages as $message) : ?>
                <div class="message">
                    <?php if (file_exists('/var/www/WebSites/tamanoir.net/app/assets/images/profiles/'.$message['username'].'.png')) : ?>
                        <img src="/tamanoir.net/app/assets/images/profiles/<?= $message['username'] ?>.png" alt="profile picture">
                    <?php else : ?>
                        <img src="/tamanoir.net/app/assets/images/profiles/default.png" alt="profile picture">
                    <?php endif ?>
                    <div>
                        <p class="username"><?= $message['username']?></p>
                        <p class="content"><?= $message['content']?></p>
                    </div>
                    <div>
                        <p class="date"><?= $message['date']?></p>
                        <?php if ($userID === $message['author_id']) : ?>
                            <button onclick="deleteMessage(<?= $message['discussion_id'] ?>,<?= $message['id'] ?>)">delete</button>
                        <?php endif ?>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <?php if (isset($messages)) : ?>
        <div id="input">
            <input type="text" id="message-input">
            <input type="submit" id="message-send" value="send">
        </div>
        <script>
            var discussionID = <?= $_GET['discussion'] ?>;
        </script>
    <?php endif ?>
    <script defer src="assets/js/discussions.js">
    </script>
    <script>
    var userID = <?= $userID ?>;
    </script>
    <script>
        


var refresh = () => {
    messageContainer.innerHTML = '';
    fetchMessages()
    socket.send(JSON.stringify({request: 'refresh',conversation: [1,2]}));
}

const socket = new WebSocket('wss://www.tamanoir.net/api/socket');

socket.onopen =  function () {
    console.log('%cConnected to WS Server ✅', 'font-weight: bold; color: green;')
    socket.send(JSON.stringify({request: 'initialise',conversation: [1,2]}));
};


socket.onmessage = function(msg) {
    msg = JSON.parse(msg.data);
    console.log(messageContainer,msg);
};



    </script>
</main>