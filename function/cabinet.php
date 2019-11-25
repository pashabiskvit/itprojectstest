<?php
switch ($page){
    case "confirm":
        $userId = clear_variable($_GET["userid"]);
        $confirmCode = clear_variable($_GET["confirmdode"]);

        if($userLoginData["status"]){
            redirect($config["base_url"]);
        }
        if($user->testConfirm($confirmCode)){
            if($user->confirm($confirmCode)){
                $view->set('resultText', $phrase[31]);
            }else{
                $view->set('resultText', $error[13]);
            }
        }else{
            $view->set('resultText', $error[11]);
        }
        $view->set('title', $phrase[30]);
        $view->display('head.tpl');
        $view->display('/cabinet/confirm.tpl');
        $view->display('footer.tpl');
        break;

}