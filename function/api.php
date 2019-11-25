<?php
switch ($method){
    case "user":
        switch ($action){
            case "signup":
                //чистим переменные
                $FirstName = clear_variable($_POST["FirstName"]);
                $LastName = clear_variable($_POST["LastName"]);
                $email = clear_variable($_POST["email"]);
                $password = clear_variable($_POST["password"]);
                $check = clear_variable($_POST["check"]);
                $avatar = $_FILES["avatar"];
                //Проверяем все обязательные поля
                if(!isset($FirstName) or !isset($LastName) or !isset($email) or !isset($password) or !isset($check)){
                    $status["status"] = false;
                    $status["errorText"] = $error[5];
                    $status = json_encode($status);
                    echo $status;
                    die();
                }
                //проверяем согласие с правилами
                if($check != "on"){
                    $status["status"] = false;
                    $status["errorText"] = $error[6];
                    $status = json_encode($status);
                    echo $status;
                    die();
                }
                //проверяем пользователя по email
                $testUser = $user->testEmail($email);
                if ($testUser != true){
                    $status["status"] = false;
                    $status["errorText"] = $error[3];
                    $status = json_encode($status);
                    echo $status;
                    die();
                }

                //проверяем аватар
                if(isset($avatar["tmp_name"]) && strlen($avatar["tmp_name"]) != 0){
                    $testFile = testFile($avatar);
                    if ($testFile != true){
                        $status["status"] = false;
                        $status["errorText"] = $error[$testFile];
                        $status = json_encode($status);
                        echo $status;
                        die();
                    }
                    //загружаем аватар
                    $avatarUpload = uploadFile($avatar, "avatar");
                    if(!$avatarUpload){
                        $status["status"] = false;
                        $status["errorText"] = $error[4];
                        $status = json_encode($status);
                        echo $status;
                        die();
                    }
                }else{
                    $avatarUpload = "/src/img/noAvatar.png";
                }
                $confirmCode = generateRandomString(25);
                $createUser = $user->create($FirstName,$LastName,$email,$password,$avatarUpload,$confirmCode,$userIp);

                if($createUser != false){
                    sendMail($email,$phrase[23],"{$phrase[24]} {$config["baseUrl"]}/cabinet/confirm/{$createUser["userId"]}/{$confirmCode}");
                    $status["status"] = true;
                    $status["Text"] = $phrase[25];
                    $status["request"] = $config["baseUrl"];
                    $status = json_encode($status);
                    echo $status;
                    die();
                }else{
                    $status["status"] = false;
                    $status["errorText"] = $error[6];
                    $status = json_encode($status);
                    echo $status;
                    die();
                }
                break;
            case "signin":
                $email = clear_variable($_POST["email"]);
                $password = clear_variable($_POST["password"]);
                if(isset($_POST["request"])){
                    $request = clear_variable($_POST["request"]);
                }else{
                    $request = $config["baseUrl"];
                }
                if(!isset($email) or !isset($password)){
                    $status["status"] = false;
                    $status["errorText"] = $error[5];
                    $status = json_encode($status);
                    echo $status;
                    die();
                }
                //получаем данные пользователя
                $userInfo = $user->info($email);
                $userId = $userInfo["id"];
                //авторизация
                $loginStatus = $user->login($email, $password);
                if($loginStatus["status"]){
                    $status["status"] = true;
                    $status["Text"] = $phrase[29];
                    $status["login"] = $loginStatus["login"];
                    $status["token"] = $loginStatus["token"];
                    $status["request"] = $request;
                    $status = json_encode($status);
                    echo $status;
                    die();
                }else{
                    $status["status"] = false;
                    $status["errorText"] = $error[$loginStatus["error"]];
                    $status = json_encode($status);
                    echo $status;
                    die();
                }
                break;
            case "logout":
                $logoutStatus = $user->logout($userLoginData["info"]["email"]);
                if($logoutStatus["status"]){
                    $status["status"] = true;
                    $status["Text"] = "";
                    $status["request"] = $config["baseUrl"];
                    $status = json_encode($status);
                    echo $status;
                    die();
                }else{
                    $status["status"] = false;
                    $status["errorText"] = $error[0];
                    $status["request"] = $config["baseUrl"];
                    $status = json_encode($status);
                    echo $status;
                    die();
                }
                break;
        }
        break;
}