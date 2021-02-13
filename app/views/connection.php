<main id="connection">
    <svg viewBox="0 0 1920 114" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="svg-b" d="M0.00012207 67.6779C294 221.678 660.5 -69.3221 960 67.6779C1259.5 204.678 1638 -65.3221 1920 67.6779V0H0.00012207V67.6779Z"/>
    </svg>

    <form method="post">
        <input type="username" name="username" placeholder="username">

        <div class="pass-container">
            <input type="password" name="password" placeholder="password">
            <div class="show-pass">
                <img src="/TamaBlog/images/svg/pass_show.svg" alt="see password">
            </div>
        </div>

        <?php if (isset($error)) : ?>
            <div class="error"><?= $error ?></div>
        <?php endif ?>
        
        <input type="submit" value="login">
    </form>
    <script>
    document.querySelector(".show-pass").addEventListener('click', () => {
        if (document.querySelector("input[name=password]").type !== "text") {
            document.querySelector("input[name=password]").type = "text";
            document.querySelector(".show-pass > img").src = "/tamanoir.net/app/assets/svg/pass_hide.svg";
        } else {
            document.querySelector("input[name=password]").type = "password";
            document.querySelector(".show-pass > img").src = "/tamanoir.net/app/assets/svg/pass_show.svg";
        }
    })
    </script>
</main>