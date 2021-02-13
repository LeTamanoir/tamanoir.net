<main id="home">
    <div>
        <p>Welcome <?= $username ?> !</p>
    </div>
    <svg viewBox="0 0 1920 114" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="svg-b" d="M0.00012207 67.6779C294 221.678 660.5 -69.3221 960 67.6779C1259.5 204.678 1638 -65.3221 1920 67.6779V0H0.00012207V67.6779Z"/>
    </svg>
    
    <div>
        <?php if (file_exists('/var/www/WebSites/tamanoir.net/app/assets/images/profiles/'.$username.'.png')) : ?>
            <img src="/tamanoir.net/app/assets/images/profiles/<?= $username ?>.png" alt="profile picture">
        <?php else : ?>
            <img src="/tamanoir.net/app/assets/images/profiles/default.png" alt="profile picture">
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
</main>