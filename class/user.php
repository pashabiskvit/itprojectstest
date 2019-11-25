<?php


class user
{
    private $db;

    public function __construct($db_connect) {
        $this->db = $db_connect;
    }
    function info($email){
        if($info = $this->db->prepare("SELECT * FROM `users` WHERE `email` = :email;")){
            if($info->bindValue(":email", $email, PDO::PARAM_STR)){
                if($info->execute()){
                    if($data = $info->fetch(PDO::FETCH_ASSOC)){
                        return $data;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    function inspection($email,$userToken){
        if($inspection = $this->db->prepare("SELECT * FROM `users` WHERE `email` = :email;")){
            if($inspection->bindValue(":email", $email, PDO::PARAM_STR)){
                if($inspection->execute()){
                    if($data = $inspection->fetch(PDO::FETCH_ASSOC)){
                        if($data["token"] == $userToken){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    function login($email, $userPassword){
        if($login = $this->db->prepare("SELECT * FROM `users` WHERE `email` = :email;")){
            if($login->bindValue(":email", $email, PDO::PARAM_STR)){
                if($login->execute()){
                    if($data = $login->fetch(PDO::FETCH_ASSOC)){
                        if($data["email"] == $email){
                            if(password_verify($userPassword, $data["passwordhash"])){
                                if($data["status"] != 1){
                                    $result = array(
                                        "status" => false,
                                        "error" => 8,
                                        "login" => null,
                                        "token" => null
                                    );
                                    return $result;
                                }
                                if($token = $this->addToken($email)){
                                    $result = array(
                                        "status" => true,
                                        "login" => $email,
                                        "token" => $token
                                    );
                                    return $result;
                                }else{
                                    $result = array(
                                        "status" => false,
                                        "error" => 9,
                                        "login" => null,
                                        "token" => null
                                    );
                                    return $result;
                                }
                            }else{
                                $result = array(
                                    "status" => false,
                                    "error" => 10,
                                    "login" => null,
                                    "token" => null
                                );
                                return $result;
                            }
                        }else{
                            $result = array(
                                "status" => false,
                                "error" => 10,
                                "login" => null,
                                "token" => null
                            );
                            return $result;
                        }
                    }else{
                        $result = array(
                            "status" => false,
                            "error" => 0,
                            "login" => null,
                            "token" => null
                        );
                        return $result;
                    }
                }else{
                    $result = array(
                        "status" => false,
                        "error" => 0,
                        "login" => null,
                        "token" => null
                    );
                    return $result;
                }
            }else{
                $result = array(
                    "status" => false,
                    "error" => 0,
                    "login" => null,
                    "token" => null
                );
                return $result;
            }
        }else{
            $result = array(
                "status" => false,
                "error" => 0,
                "login" => null,
                "token" => null
            );
            return $result;        }
    }
    function addToken($email){
        $time = time();
        $token = md5($time);
        if($addToken = $this->db->prepare("UPDATE `users` set token = :token, authorizationDate = :lastloginDate WHERE email = :email")){
            if($addToken->bindValue(":token", $token, PDO::PARAM_STR) && $addToken->bindValue(":lastloginDate", $time, PDO::PARAM_STR) && $addToken->bindValue(":email", $email, PDO::PARAM_STR)){
                if($addToken->execute()){
                    return $token;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function logout($user_login){
        $db = $this->db;
        if($login = $db->prepare("UPDATE `users` set token = null WHERE `email` = :login;")){
            if($login->bindValue(":login", $user_login, PDO::PARAM_STR)){
                if($login->execute()){
                    setcookie ("login", "", time() - 3600,'/');
                    setcookie ("token", "", time() - 3600, '/');
                    $result = array(
                        "status" => true
                    );
                    return $result;
                }else{
                    $result = array(
                        "status" => false
                    );
                    return $result;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function confirm($confirmCode){
        if($confirm = $this->db->prepare("UPDATE `users` set status = 1, confirmDate = :confirmDate WHERE `confirmCode` = :confirmCode AND status = 0;")){
            if($confirm->bindValue(":confirmCode", $confirmCode, PDO::PARAM_STR) &&
                $confirm->bindValue(":confirmDate", time(), PDO::PARAM_STR)){
                if($confirm->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    function testConfirm($confirmCode){
        if($testConfirm = $this->db->prepare("SELECT COUNT(*) FROM users WHERE confirmCode = :confirmCode AND status = 0;")){
            if($testConfirm->bindValue(":confirmCode", $confirmCode, PDO::PARAM_STR)){
                if($testConfirm->execute()){
                    if($data = $testConfirm->fetch(PDO::FETCH_ASSOC)){
                        if($data["COUNT(*)"] > 0){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function create($FirstName,$LastName,$email,$password,$avatarUpload,$confirmCode,$ip){
        $time = time();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        if($create = $this->db->prepare("INSERT INTO `users`(`FirstName`, `LastName`, `email`, `passwordhash`, `ip`, `confirmCode`, `createDate`, `avatarPatch`) VALUES (:FirstName, :LastName, :email, :passwordhash, :ip, :confirmCode, :createDate, :avatarPatch);")){
            if($create->bindValue(":FirstName", $FirstName, PDO::PARAM_STR) &&
                $create->bindValue(":LastName", $LastName, PDO::PARAM_STR) &&
                $create->bindValue(":email", $email, PDO::PARAM_STR) &&
                $create->bindValue(":passwordhash", $passwordHash, PDO::PARAM_STR) &&
                $create->bindValue(":ip", $ip, PDO::PARAM_STR) &&
                $create->bindValue(":confirmCode", $confirmCode, PDO::PARAM_STR) &&
                $create->bindValue(":avatarPatch", $avatarUpload, PDO::PARAM_STR) &&
                $create->bindValue(":createDate", $time, PDO::PARAM_STR)
            ){
                if($create->execute()){
                    $result["userId"] = $this->db->lastInsertId();
                    $result["status"] = true;
                    return $result;
                }else{
                    $result["status"] = false;
                    return $result;
                }
            }else{
                $result["status"] = false;
                return $result;
            }
        }else{
            $result["status"] = false;
            return $result;
        }
    }
    function testEmail($email){
        if($testEmail = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email;")){
            if($testEmail->bindValue(":email", $email, PDO::PARAM_STR)){
                if($testEmail->execute()){
                    if($data = $testEmail->fetch(PDO::FETCH_ASSOC)){
                        if($data["COUNT(*)"] > 0){
                            return false;
                        }else{
                            return true;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
}