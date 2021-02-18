<main id="connection">
    <form method="post">
        <input type="username" name="username" placeholder="username">

        <div class="pass-container">
            <input type="password" name="password" placeholder="password">
            <div class="show-pass">
                <img src="assets/svg/pass_show.svg" alt="see password">
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
            document.querySelector(".show-pass > img").src = "assets/svg/pass_hide.svg";
        } else {
            document.querySelector("input[name=password]").type = "password";
            document.querySelector(".show-pass > img").src = "assets/svg/pass_show.svg";
        }
    })
    </script>
</main>