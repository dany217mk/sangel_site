<?php
    date_default_timezone_set('Europe/Moscow');
    define("SITE_ROOT", "/sangel_site");
    define("FULL_SITE_ROOT", "http://localhost" . SITE_ROOT);
    define("FILE_ROOT", "/sangel_site");
    define("FULL_FILE_ROOT", "D://xampp/htdocs" . FILE_ROOT);
    define("ASSETS", FULL_SITE_ROOT . "/assets");
    define("JS", ASSETS . "/js");
    define("CSS", ASSETS . "/css");
    define("IMG", ASSETS . "/img");
    define("IMG_PRODUCT", ASSETS . "/img_product");
    define("LIBS", ASSETS . "/libs");
    define("REQUEST_URI_EXIST", "/sangel_site/");
    define("SERVER_NAME", 'Sangel');
    define("CONTACT_ADMIN", 'development');
    define("ADMIN_EMAIL", 'checkbraininfo@yandex.ru');
    define("SITE_STATUS", 'open');
    define("SITE_STATUS_CLOSE", '/sangel_site/report/technical');
    define("NO_SCRIPT_PAGE", '/sangel_site/no_scripts');
    $db = array(
           'host' => 'localhost',
           'user' => 'root',
           'password' => '',
           'db_name' => 'sangel',
           'charset' => 'utf8'
       );
