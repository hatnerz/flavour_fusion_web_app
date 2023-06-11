<?php

class Controller_Profile extends Controller
{
    function __construct()
	{
		$this->model = new Model_Profile();
		$this->view = new View();
	}

    function action_index()
    {
        $data = array();
        $data = Meta::add_meta_data($data, "Профіль", null, null);
        if($data['user'] == null) {
            header("Location: /login");
            exit();
        }
        $this->view->generate('profile_view.php', 'template_view.php', $data);
    }

    function action_changeinfo()
    {
        $data = array();
        $data = Meta::add_meta_data($data, "Профіль", null, null);
        $login = $_POST['login'];
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $incorrect_count = 0;
        if($login == null || $login == "") {
            $login = $data['user']->login;
            $incorrect_count+=1;
        }
            
        if($first_name == null || $first_name == "") {
            $first_name = $data['user']->first_name;
            $incorrect_count+=1;
        }
        if($last_name == null || $last_name == "") {
            $last_name = $data['user']->last_name;
            $incorrect_count+=1;
        }
        if($incorrect_count >= 3) {
            $data = Meta::add_meta_data($data, "Профіль", null, "Заповніть хоча б одне поле для зміни");
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        }
        $result = $this->model->change_data($data['user']->id, $login, $first_name, $last_name);
        if($result == true) {
            $_SESSION["user"] = $login;
            $data = Meta::add_meta_data($data, "Профіль", null, "Дані успішно змінені");
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        }
        else {
            $data = Meta::add_meta_data($data, "Профіль", null, "Помилка при зміні даних");
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        }

    }

    function action_changepassword()
    {
        $data = array();
        $data = Meta::add_meta_data($data, "Профіль", null, null);
        $old_password = $_POST['old-password'];
        $new_password = $_POST['new-password'];
        $confirm_password = $_POST['confirm-password'];
        $incorrect_count = 0;
        if($old_password == "" || $old_password == null 
        || $new_password == "" || $new_password == null
        || $confirm_password == "" || $confirm_password == null)
        {
            $data = Meta::add_meta_data($data, "Профіль", null, "Для зміни паролю заповніть усі поля");
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        }
        else
        {
            $result = $this->model->change_password($data['user']->id, $old_password, $new_password, $confirm_password);
            $notification = "NULL";
            if($result == INCORRECT_PASSWORD) {
                $notification = "Ви ввели некоретний пароль";
            }
            else if ($result == PASSWORDS_MATCH) {
                $notification = "Старий та новий паролі співпадають";
            }
            else if ($result == INCORRECT_PASSWORD_CONFIRM) {
                $notification = "Некоретне підтвердження паролю";
            }
            else if ($result == EASY_PASSWORD) {
                $notification = "Введіть пароль, який задовільняв би вимогам: хоча б одна цифра, буква, спец.символ та мінімум 8 символів";

            }
            else if ($result == PASSWORD_CHANGED) {
                $notification = "Пароль успішно змінено";
            }
            else {
                $notification = "Помилка при зміні паролю";
            }

            $data = Meta::add_meta_data($data, "Профіль", null, $notification);
            $this->view->generate('profile_view.php', 'template_view.php', $data);
        }
    }

    function action_logout()
    {        
        if(!isset($_SESSION["user"])) {
            header("Location: /login");
            exit();
        }
        else {
            unset($_SESSION["user"]);
            $data = array();
            $data = Meta::add_meta_data($data, "Профіль", null, "Ви успішно вийшли з аккаунту");
            $this->view->generate('login_view.php', 'template_view.php', $data);
        }

    }

    function action_uploadimg()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
            $data = array();
            $data = Meta::add_meta_data($data, "Завантаження фото", null, null);
            if($data['user'] != null) {

                // Проверка, является ли файл изображением (можете настроить проверку в зависимости от своих требований)
                $originalFileName = $_FILES['file']['name'];
                $extension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
                $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
                if (!in_array($extension, $allowedExtensions)) {
                    echo 'Ошибка: Можно загружать только изображения в форматах JPG, JPEG, PNG или GIF.';
                    exit();
                }

                $targetDir = MEDIA_PATH.'profile_img/'; // Папка, в которую нужно сохранить файлы

                $newFileName = ((string)$data['user']->id). '.' .$extension;
                $targetFile = $targetDir . $newFileName;

                // Перемещение файла из временной директории в целевую папку
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                    DB::do_sql("UPDATE `user` SET `profile_img` = ? WHERE `user_id` = ?", array($newFileName, $data['user']->id));
                    echo 'Фото профіля успішно змінено';
                } else {
                    echo 'Помилка при завантаженні файлу';
                }
            }
            else
            {
                echo "Помилка: ви повинні бути авторизовані";
            }
            
        } else {
            echo 'Помилка: некоректний запит';
            exit();
        }
    }
}