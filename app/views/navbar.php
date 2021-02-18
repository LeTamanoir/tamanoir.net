<header>
    <div>
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
    </div>
    <svg viewBox="0 0 1920 47" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="svg-b" d="M-0.000106812 27.9022C294 91.3934 660.5 -28.5801 960 27.9022C1259.5 84.3846 1638 -26.931 1920 27.9022V0H-0.000106812V27.9022Z"/>
    </svg>
</header>