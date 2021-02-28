<main id="home">
    <h2>Welcome <?= $username ?> !</h2>
    <div>
        <?php if (file_exists('/var/www/WebSites/tamanoir/app/assets/images/profiles/'.$username.'.png')) : ?>
            <img src="/tamanoir/app/assets/images/profiles/<?= $username ?>.png" alt="profile picture">
        <?php else : ?>
            <img src="/tamanoir/app/assets/images/profiles/default.png" alt="profile picture">
        <?php endif ?>

        <table>
            <tr>
                <th>Username</th>
                <td><?= $username ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $useremail ?></td>
            </tr>
        </table>


       
    </div>
    <?php if ($userTrust === "trusted") : ?>
        <h2>Latest uploads :</h2>

        <div id="news">
            
            <?php foreach ($news as $new) : ?>
                <a style="background-image: url('assets/images/streaming/<?= $new['show'] ?>/S<?= $new['season'] ?>/banner.png');" href="?page=Streaming&show=<?= $new['show'] ?>&season=<?= $new['season'] ?>&resume=<?= $new['episode'] ?>&time=1">
                    <div>
                        episode : <?= $new['episode'] ?>, <?= $new['video'] ?><br>
                        season : <?= $new['season'] ?>
                    </div>
                </a>
            <?php endforeach ?>

        </div>
    <?php endif ?>
</main>