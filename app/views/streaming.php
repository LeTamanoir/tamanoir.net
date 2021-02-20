<main id="streaming">
    <?php if ($userTrust === "trusted") : ?>

        <?php if ($show && $season) : ?>

            <a class="back" href="?page=Streaming&show=<?= $_GET['show'] ?>">back</a>
            <div class="video-player">
                <video controls poster="assets/images/streaming/banner.png">
                    <source src="" type="video/mp4">
                </video>
            </div>

            <select class="video-list" onchange="watchEpisode()">
                <option value="0">Select an episode : </option>
                <?php foreach ($episodes as $episode) : ?>

                    <option value="<?= $episode['episode'] ?>"> <?= "{$episode['episode']} : {$episode['video']}" ?></option>
                
                <?php endforeach ?>
            </select>

            <script defer src="assets/js/streaming.js"></script>
            
            <?php if (!empty($_GET['resume']) && !empty($_GET['time'])) : ?>
                <script>var resume = "api.php?show=<?= $_GET['show'] ?>&season=S<?= $_GET['season'] ?>&episode=E<?= $_GET['resume'] ?>&action=watch";var time = <?= $_GET['time'] ?>;var episode = <?= $_GET['resume'] ?>;</script>
            <?php endif ?>

            <script>var season = '<?= $_GET['season'] ?>';var show = '<?= $_GET['show'] ?>';</script>

        <?php elseif ($show) : ?>

            <a class="back" href="?page=Streaming">back</a>

            <div class="season-container">
                <?php foreach ($seasons as $season) : ?>

                    <a class="seasons" style="background-image: url('assets/images/streaming/<?= $_GET['show'] ?>/S<?= $season['season'] ?>/banner.png');" href="?page=Streaming&show=<?= $_GET['show'] ?>&season=<?= $season['season'] ?>" >
                        <div class="watch"> season : <?= $season['season'] ?> </div>
                    </a>

                <?php endforeach ?>
            </div>

        <?php else : ?>

            <?php if (!empty($displayLast)) : ?>
                <h2>Resume watching :</h2>
                <div class="last-show-container">
                    <?php foreach ($displayLast as $showLast) : ?>
                        <a class="show-resume" style="background-image: url('assets/images/streaming/<?= $showLast['show'] ?>/banner.png');" href="?page=Streaming&show=<?= $showLast['show'] ?>&season=<?= $showLast['season'] ?>&resume=<?= $showLast['episode'] ?>&time=<?= $showLast['time'] ?>">
                            <div class="watch-resume">
                                season : <?= $showLast['season'] ?><br>
                                episode : <?= $showLast['episode'] ?>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <div class="show-container">
                <?php foreach ($shows as $show) : ?>
                                    
                    <a class="show" style="background-image: url('assets/images/streaming/<?= $show['show'] ?>/banner.png');" href="?page=Streaming&show=<?= $show['show'] ?>" >
                        <div class="watch"><?= $show['show'] ?></div>
                    </a>

                <?php endforeach ?>
            </div>

        <?php endif ?>

    <?php else : ?>
        <h2 class="error">you cannot access the streaming service, for more info contact LeTamanoir</h2>
    <?php endif ?>
</main>