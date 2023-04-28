<section class="login">
      <div class="login__inner">
        <form class="form login-form" method="post" action="/login/check">
            <div class="form__inner">
                <h2 class="form__title">Авторизація</h2>
                <div class="form__fields">
                    <div class="form__field">
                        <label for="login-form__username">Логин:</label>
                        <input type="text" id="login-form__username" name="username" required>
                    </div>
                    <div class="form__field">
                        <label for="login-form__password">Пароль:</label>
                        <input type="password" id="login-form__password" name="password" required>
                    </div>
                </div>
                <button class="form__submit-button" type="submit">Увійти</button>
                <a class="login__go-registration-button form__alternative_button" href="/registration">Реєстрація</a>
            </div>
        </form>
    </div>
</section>