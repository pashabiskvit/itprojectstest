<?php

function MyAutoload($class)
{
    require_once "{$_SERVER['DOCUMENT_ROOT']}/class/$class.php";
}
spl_autoload_register('MyAutoload');

function clear_variable($query){
    $query = trim($query);
    $query = strip_tags($query);
    $query = htmlentities($query);
    $query = stripslashes($query);
    return $query;
}
function get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function redirect($url,$request = null){
    if($request != null){
        header("Location: {$url}?request={$request}");
    }else{
        header("Location: {$url}");
    }

}
function generateRandomString($length = 15){
    $characters='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0987654321'.time();
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = $length; $i > 0; $i--)
    {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}
function testFile($file, $type = "avatar"){
    switch ($type){
        case "avatar":
            $trueArrayList = array("image/jpeg","image/png", "image/gif");
            if(!in_array($file["type"], $trueArrayList)){
                return 1;
            }
            break;
    }
    if($file["size"] > 512000){
        return 2;
    }
    return true;
}
function uploadFile($file, $dir = "file"){
    $uniqId = uniqid();
    $fileName = str_replace(' ','-',$file["name"]);
    $fileName = "{$uniqId}-$fileName";
    $filePatch = "/upload/{$dir}/{$fileName}";
    if(copy($file["tmp_name"], "{$_SERVER['DOCUMENT_ROOT']}{$filePatch}")) {
        unlink($file["tmp_name"]);
        return $filePatch;
    }else{
        unlink($file["tmp_name"]);
        return false;
    }
}
function sendMail($to,$subject,$message){
    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: Pavel <pasha.biskvit@gmail.com>\r\n";
    mail($to, $subject, $message, $headers);
}