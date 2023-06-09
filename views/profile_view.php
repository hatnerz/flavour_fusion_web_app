<section class="profile">
    <div class="container">
        <div class="profile__inner container__inner_shadow">
            
            <div class="profile-header">
                <div class="profile-header__img-container">
                    <img src="/../media/profile_background.jpg" alt="profile header" class="profile-header__img">
                </div>
            </div>

            <div class="profile-main">
                <div class="profile-main__title">
                    <h1>Профіль</h1>
                </div>
                <div class="profile-main__info">

                    <div class="profile-main__current-info profile-main__info-block">

                        <div class="profile-main__user">
                            <h2 class="profile-main__title">Інформація про користувача</h2>
                            <div class="profile-main__login profile-main__user-info">
                                Логін: <?= $user->login ?>
                            </div>
                            <div class="profile-main__first-name profile-main__user-info">
                                Ім'я: <?= $user->first_name ?>
                            </div>
                            <div class="profile-main__last-name profile-main__user-info">
                                Прізвище: <?= $user->last_name ?>
                            </div>
                        </div>

                        <div class="profile-main__posts">
                        <h2 class="profile-main__title">Статті та рецепти</h2>
                        <button onclick="redirectToPage()" class = "posts__add-post form__submit-button">Додати статтю</button>
                        <script>
                            function redirectToPage() {
                                window.location.href = "/addrecipe";
                            }
                        </script>
                        </div>

                        <h2 style = "margin-top: 40px" class="profile-main__title">Авторизація</h2>
                        <button onclick="logOut()" class = "posts__add-post form__submit-button">Вийти з аккаунту</button>
                        <script>
                            function logOut() {
                                window.location.href = "/profile/logout";
                            }
                        </script>



                    </div>

                    <div class="profile-main__change-info profile-main__info-block">

                        <div class="profile-main__change-main-info">
                            <h2 class="profile-main__title">Змінити інформацію</h2>
                            <form action="/profile/changeinfo" class="change-profile-info-form" method="post">
                                <div class="change-profile-info-form__block">
                                    <label for="login" class="change-profile-info-form__label">Логін</label>
                                    <input name="login" type="text">
                                </div>
                                <div class="change-profile-info-form__block">
                                    <label for="" class="change-profile-info-form__label">Ім'я</label>
                                    <input name="first-name" type="text">
                                </div>
                                <div class="change-profile-info-form__block">
                                    <label for="" class="change-profile-info-form__label">Прізвище</label>
                                    <input name="last-name" type="text">
                                </div>
                                <div class="change-profile-info-form__block">
                                    <input value = "Змінити інформацію" type="submit" class="form__submit-button change-profile-info-form__submit">
                                </div>
                                
                            </form>
                        </div>

                        <div class="profile-main__change-password">
                            <h2 class="profile-main__title">Змінити пароль</h2>
                                <form action="/profile/changepassword" class="change-profile-password-form" method="post">
                                    <div class="change-profile-password-form__block">
                                        <label for="old-password" class="change-profile-info-form__label">Старий пароль</label>
                                        <input name="old-password" type="password">
                                    </div>
                                    <div class="change-profile-password-form__block">
                                        <label for="new-password" class="change-profile-info-form__label">Новий пароль</label>
                                        <input name="new-password" type="password">
                                    </div>
                                    <div class="change-profile-password-form__block">
                                        <label for="confirm-password" class="change-profile-info-form__label">Повторіть новий пароль</label>
                                        <input name="confirm-password" type="password">
                                    </div>
                                    <div class="change-profile-password-form__block">
                                        <input value = "Змінити пароль" type="submit" class="form__submit-button change-profile-password-form__submit">
                                    </div>
                                </form>
                        </div>
                        
                    </div>
                </div>
            </div>    

        </div>
    </div>
</section>