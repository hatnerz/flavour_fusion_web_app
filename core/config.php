<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("IP_LOG_PATH", ROOT. '/logs/logs.txt');
define("USER_LOG_PATH", ROOT. '/logs/user_logs.txt');
define("STYLE_PATH", ROOT.'/style/style.css');
define("MEDIA_PATH", ROOT.'/media/');
define("SCRIPTS_PATH", ROOT.'/scripts/');
define("CORE_PATH", ROOT.'/core/');


define("INCORRECT_PASSWORD", 0);
define("INCORRECT_LOGIN", -1);
define("CORRECT_AUTHENTICATION", 1);
define("PASSWORDS_MATCH", 3);
define("INCORRECT_PASSWORD_CONFIRM", 4);
define("CORRECT_PASSWORD_CHANGE", 2);
define("EASY_PASSWORD", 5);
define("PASSWORD_CHANGED", 6);
define("ERROR", 7);