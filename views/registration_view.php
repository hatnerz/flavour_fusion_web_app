<section class="registration">
    <div class="registration__inner">
        <form class="form registration-form" method="post" action="/registration/register">
            <div class="form__inner">
                <h2 class="form__title">Реєстрація</h2>
                <div class="form__fields">
                    <div class="form__field">
                    <label for="registration-form__username">Логин:</label>
                    <input type="text" id="registration-form__username" name="username" required>
                    </div>
                    <div class="form__field">
                    <label for="login-form__password">Пароль:</label>
                    <input type="password" id="registration-form__password" name="password" required>
                    </div>
                    <div class="form__field">
                    <label for="registration-form__first-name">Ім'я:</label>
                    <input type="text" id="registration-form__first-name" name="first-name" required>
                    </div>
                    <div class="form__field">
                    <label for="registration-form__last-name">Прізвище:</label>
                    <input type="text" id="registration-form__last-name" name="last-name" required>
                    </div>
                </div>
                <button class="form__submit-button" type="submit">Зареєструватися</button>
                <a class="registration__go-login-button form__alternative_button" href="/login">Авторизація</a>
            </div>
        </form>
    </div>
</section>