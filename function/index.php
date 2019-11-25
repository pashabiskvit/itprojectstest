<?php
switch ($page){
    case "index":
        if($userLoginData["status"]){
            $view->set('title', $phrase[32]);
            $view->set('userInfo', $userLoginData["info"]);
            $view->display('head.tpl');
            $view->display('/index/index.tpl');
            $view->display('footer.tpl');
        }else{
            $view->set('title', $phrase[1]);
            $view->display('head.tpl');
            $view->display('/index/signin.tpl');
            $view->display('footer.tpl');
        }

        break;
    case "signup":
        $view->set('title', $phrase[11]);
        $view->display('head.tpl');
        $view->display('/index/signup.tpl');
        $view->display('footer.tpl');
        break;
}