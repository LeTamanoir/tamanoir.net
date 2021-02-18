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
</main>