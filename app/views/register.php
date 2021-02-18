<main id="register">
    <form method="post">

        <h2>Email</h2>
        <input type="email" name="email" placeholder="email">
        <input type="email" name="confirm-email" placeholder="confirm email">
        
        <h2>Username</h2>
        <input type="text" name="username" placeholder="username">

        <h2>Password</h2>
        <div class="pass-container">
            <input type="password" name="password" placeholder="password">
            <div class="show-pass">
                <img src="assets/svg/pass_show.svg" alt="see password">
            </div>
        </div>
        <div class="pass-container">
            <input type="password" name="confirm-password" placeholder="confirm password">
            <div class="show-pass-confirm">
                <img src="assets/svg/pass_show.svg" alt="see password">
            </div>
        </div>

        <?php if (isset($info)) : ?>
            <div class="error"><?= var_dump($info) ?></div>
        <?php endif ?>
        
        <input type="submit" value="register">
    </form>
    <script defer>
    document.querySelector(".show-pass").addEventListener('click', () => {
        if (document.querySelector("input[name=password]").type !== "text") {
            document.querySelector("input[name=password]").type = "text";
            document.querySelector(".show-pass > img").src = "assets/svg/pass_hide.svg";
        } else {
            document.querySelector("input[name=password]").type = "password";
            document.querySelector(".show-pass > img").src = "assets/svg/pass_show.svg";
        }
        
    })
    document.querySelector(".show-pass-confirm").addEventListener('click', () => {
        if (document.querySelector("input[name=confirm-password]").type !== "text") {
            document.querySelector("input[name=confirm-password]").type = "text";
            document.querySelector(".show-pass-confirm > img").src = "assets/svg/pass_hide.svg";
        } else {
            document.querySelector("input[name=confirm-password]").type = "password";
            document.querySelector(".show-pass-confirm > img").src = "assets/svg/pass_show.svg";
        }
    })
    </script>
</main>