<section class="profile">
  <div class="container">
    <div class="profile__inner container__inner_shadow">
      <div class="profile-header">
        <div class="profile-header__img-container">
          <img src="/../media/background.jpg" alt="profile header" class="profile-header__img">
        </div>
        <div class="profile-image">
          <input type="file" id="profile-photo-input" style="display: none" accept="image/*">
          <label for="profile-photo-input" class="profile-photo-label">
            <img src=<?= $user->profile_img == "" ? "/media/prof.png" : "/media/profile_img/".$user->profile_img?> alt="profile image" class="profile-image">
          </label>
          </div>
          <p class="profile-image__help-text">Для завантаження (оновлення) фото профілю натисніть на нього</p>
        
      </div>
      <div class="profile-main">
        <div class="profile-main__title">
          <h1>Профіль</h1>
        </div>
        <div class="profile-main__info">
          <div class="profile-main__current-info profile-main__info-block">
            <div class="profile-main__user">
              <h2 class="profile-main__subtitle">Інформація про користувача</h2>
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
            <?php if ($user->role_id == 1) {?>
            <div class="profile-main__posts">
              <h2 class="profile-main__subtitle">Статті та рецепти</h2>
              <button onclick="redirectToPage()" class="posts__add-post form__submit-button">Додати статтю</button>
            </div>
            <?php } ?>


          </div>
          <div class="profile-main__change-info profile-main__info-block">
            <div class="profile-main__change-main-info">
              <h2 class="profile-main__subtitle">Змінити інформацію</h2>
              <form action="/profile/changeinfo" class="change-profile-info-form" method="post">
                <div class="change-profile-info-form__block">
                  <label for="login" class="change-profile-info-form__label">Логін</label>
                  <input name="login" type="text">
                </div>
                <div class="change-profile-info-form__block">
                  <label for="first-name" class="change-profile-info-form__label">Ім'я</label>
                  <input name="first-name" type="text">
                </div>
                <div class="change-profile-info-form__block">
                  <label for="last-name" class="change-profile-info-form__label">Прізвище</label>
                  <input name="last-name" type="text">
                </div>
                <div class="change-profile-info-form__block">
                  <input value="Змінити інформацію" type="submit" class="form__submit-button change-profile-info-form__submit">
                </div>
              </form>
            </div>
            <div class="profile-main__change-password">
              <h2 class="profile-main__subtitle">Змінити пароль</h2>
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
                  <input value="Змінити пароль" type="submit" class="form__submit-button change-profile-password-form__submit">
                </div>
              </form>
            </div>
          </div>
          <div class="profile-main__authentication">
              <button onclick="logOut()" class="posts__add-post form__submit-button">Вийти з аккаунту</button>
          </div>
        </div>
      </div>
    </div>
  </div>
                                
</section>

<style>.profile-main__title h1 {
    text-align: center;
  }

  .profile-header {
    text-align: center;
    padding: 20px;
    background-color: #ffffff;
    position: relative;
  }

  .profile-header__img-container {
    margin-bottom: 20px;
  }

  .profile-header__img {
    width: 100%;
    height: 300px;
    object-fit: cover;
  }

  .profile-main__title {
    font-size: 24px;
    margin-bottom: 10px;
  }

  .profile-main__info {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }

  .profile-main__current-info {
    flex: 0 0 100%;
    background-color: #ffffff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    text-align: center;
  }

  .profile-main__user-info {
    margin-bottom: 10px;
    font-size: 18px;
  }

  .profile-main__subtitle {
    font-weight: bold;
  }

  .profile-main__posts,
  .profile-main__change-info {
    flex-basis: 100%;
    background-color: #ffffff;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .profile-main__change-info {
    margin: 0 20px;
  }

  .posts__add-post,
  .form__submit-button {
    background-color: #3CA43A;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
  }

  .posts__add-post:hover,
  .form__submit-button:hover {
    background-color: #006400;
  }

  .profile-main__change-info {
    display: flex;
    gap: 40px;
  }

  .profile-image__help-text {
    text-align: right;
  }


  .profile-main__change-main-info,
  .profile-main__change-password {
    margin-bottom: 20px;
    flex-grow: 1;
  }

  .change-profile-info-form__label {
    display: block;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 8px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  .change-profile-info-form__submit {
    background-color: #3CA43A;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
  }

  .profile-main__authentication {
    width: 100%;
    display: flex;
    justify-content: right;
  }

  .profile-main__authentication .posts__add-post {
    background-color: #dc3545;
    padding: 10px 31px;
    margin: 15px;

  }

  .change-profile-password-form__submit {
    background-color: #3CA43A;
    padding: 10px 36px;
  }

  .profile-photo-label {
    cursor: pointer;
    display: inline-block;
    position: relative;
    width: 150px;
    height: 150px;
    margin-bottom: -200px;
    z-index: 2;
  }

  .profile-photo-label img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .profile-photo-label::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    opacity: 0;
    pointer-events: none;
  }

  .profile-photo-label input[type="file"] {
    display: none;
  }

  .profile-photo-label input[type="file"]:focus+img {
    outline: 2px solid green;
  }

  .profile-photo-label input[type="file"]:focus+img+::after {
    opacity: 0.5;
  }

  .profile-photo-label input[type="file"]:valid+::after {
    opacity: 1;
  }

  .profile-photo-label::after {
    background-image: url("/../media/profile_image.jpg");
  }

  .profile-image {
    position: absolute;
    top: 80px;
    left: 30px;
    z-index: 1;
    height: 150px;
    border-radius: 72px;
  }</style>
<script>
 function logOut() {
 window.location.href = "/profile/logout";
 }
 function redirectToPage() {
     window.location.href = "/addrecipe";
}

  function handleProfilePhotoUpload(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
      const profileImg = document.querySelector(".profile-image img");
      profileImg.src = e.target.result;
    };

    if (file) {
      reader.readAsDataURL(file);
    }

    var formData = new FormData();
    formData.append("file", file);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/profile/uploadimg", true)
    xhr.onload = function() {
        if (xhr.status === 200) {
        console.log("Файл успешно загружен на сервер");
        } else {
        console.log("Произошла ошибка при загрузке файла");
        }
    };
    xhr.send(formData);
  }

  document.querySelector("#profile-photo-input").addEventListener("change", handleProfilePhotoUpload);
  
</script>
</section>
