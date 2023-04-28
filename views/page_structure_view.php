<?php
class PageTemplate
{

    static function head($title)
    {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="/style/style.css" rel="stylesheet" />
            <title><?php echo $title ?></title>
        </head>

        <?php
    }
    
    static function header($user)
    {
        ?>

        <header class="header">
            <div class="container">
                <div class="header__inner">
                    <a class="logo__link" href="/main">
                        <div class="logo">
                            <div class="logo__img-container">
                                <img class="logo__img" src="/../media/logo.png">
                            </div>
                            <div class="logo__text">
                                <div class="logo__title">
                                    FLAVOUR Fusion
                                </div>
                                <div class="logo__subtitle">
                                    Кулінарний блог
                                </div>
                            </div>
                            
                        </div>
                    </a>
                    <div class="header__left">
                        <a class="header__basket-link" href="/basket">
                            <div class="header__basket">
                                <div class="header__icon-container">
                                    <img class="header__bakset-img" alt="Basket" src="/../media/basket.svg">
                                </div>
                                <p class="header__icons-text">Інгредієнти</p>
                            </div>
                        </a>
                        <a class="header__user-profile-link" href="/login">
                            <div class="header__user-profile">
                                <div class="header__icon-container">
                                    <img src="/../media/user_profile.png" alt="Profile" class="header__user-profile-img">
                                </div>
                                <p class="header__icons-text"><?php if($user == null) echo "Авторизація"; else echo $user->login ?></p>
                            </div>
                        </a>
                    </div>                    
                </div>
            </div>
        </header>

        <?php
    }

    static function nav($choosen_element)
    {
        ?>

        <nav class="nav">
            <div class="container">
                <div class="nav__inner">
                    <div class="nav__main-menu">
                        <?php $menu_elements = [["Головна", "/main"], ["Рецепти", "/recipes"], ["Чат", "/chat"], ["Контакти", "#"]];
                            for($i = 0; $i < count($menu_elements); $i++)
                            {?>
                                <div class = "main-menu__element <?php if($i == 0) echo "main-menu__element_first"; 
                                if($menu_elements[$i][0] == $choosen_element) echo " main-menu__element-active"?>">
                                    <a href = "<?php echo $menu_elements[$i][1] ?>" class="main-menu__link <?php if($menu_elements[$i][0] == $choosen_element) echo "main-menu__link-active"?> ?>"><?php echo $menu_elements[$i][0] ?></a>
                                </div>
                            <?php }
                            ?>
                    </div>
                    <div class="nav__right-menu">
                        <div class="right-menu__element">
                            <div class="search">
                                <img class="search__icon" src="/../media/search-icon.webp">
                                <input class="search__input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <?php
    }

    static function main($content_view, $main_data)
    {
        if(is_array($main_data)) 
		{
			extract($main_data);
		}
        ?>
        
        <main class="main">
            <?php include $content_view; ?>
        </main>

        <?php
    }

    static function footer()
    {
        ?>

        <footer class="footer">
            <div class="container">
                <div class="footer__inner">
                    <div class="footer__text">
                        <span>© FLAVOUR FUSION 2023</span>
                    </div>
                    <img src="/../php/count-user.php">
                </div>
            </div>
        </footer>

        <?php
    }

    static function notification($content)
    {
        ?>

        <div class="notification">
            <div class="notification__inner">
                <p class="notification__text"><?=$content?></p>
            </div>
        </div>
        <script src="/scripts/delete_notification.js"></script>

        <?php
    }
}