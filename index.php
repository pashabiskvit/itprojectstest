<?php
//подключаем файл настроек
include_once "config.php";
//подключаем файл дополнительных функций (основной автолоад классов)
include_once "function/other.php";
//получем раздел сайта
$section = clear_variable($_GET["section"]);
//получаем страницу сайта
$page = clear_variable($_GET["page"]);
//создаем подключение к базе данных
$db_connect = new db($config["db"]["dbHost"],$config["db"]["dbName"],$config["db"]["userName"],$config["db"]["userPassword"]);
$db_connect = $db_connect->connect();
//запускаем пользователей
$user = new user($db_connect);
$userIp = get_ip(); //ip пользователя
//проверяем авторизацию пользователя
if(isset($_COOKIE["login"])){
    $userLogin = clear_variable($_COOKIE["login"]);
    $userToken = clear_variable($_COOKIE["token"]);
    $userInfo = $user->info($userLogin);
    $userLoginData = array(
        "status" => true,
        "info" => $userInfo
    );
    //проверяем авторизацию
    if($user->inspection($userLogin,$userToken) != true){
        setcookie ("login", null, time() - 360000,  '/');
        setcookie ("token", null, time() - 360000, '/');
        $userLoginData = array(
            "status" => false,
            "info" => null
        );
    }
}else{
    $userLoginData = array(
        "status" => false,
        "info" => null
    );
}
//подключаем локализацю
if(isset($_COOKIE["language"])){
    $language = clear_variable($_COOKIE["language"]);
    include_once "language/{$language}.php";
}else{
    include_once "language/ru.php";
}
//подключаем шаблонизатор
$view = new view("/view/");
$view->set('phrase', $phrase);
//подключаем файл раздела
switch ($section){
    case "index":
        include_once "function/index.php";
        break;
    case "cabinet":
        include_once "function/cabinet.php";
        break;
    case "api":
        //создадим method для апи на основе section
        $method = clear_variable($_GET["method"]);;
        //создадим action для апи на основе page
        $action = $page;
        include_once "function/api.php";
        break;
    default:
        die("Не получили раздел сайта");
        break;
}