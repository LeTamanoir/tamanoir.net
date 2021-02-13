<header>
    <h1><?= $page ?></h1>
    <nav>
        <?php if ($logged) : ?>
            <a href="?page=Home" class="<?php if ($page === "Home") { echo "clicked"; } ?>" >Home</a>
            <a href="?page=Inbox" class="<?php if ($page === "Inbox") { echo "clicked"; } ?>" >Inbox</a>
            <a href="?page=Streaming" class="<?php if ($page === "Streaming") { echo "clicked"; } ?>" >Streaming</a>
            <a href="?page=Settings" class="<?php if ($page === "Settings") { echo "clicked"; } ?>" >Settings</a>
            <a href="?page=Logout" class="logout">Logout</a>
        <?php else : ?>
            <a href="/tamanoir.net/index.html">back</a>
        <?php endif ?>
        <div id="darkmode-container">
            <input id="darkmode-input" type="checkbox">
            <label for="darkmode-input" id="darkmode">
                <span></span>
            </label>
        </div>
    </nav>
</header>