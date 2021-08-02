<?php


class Utils
{

    public static function redirectToUrl(string $url){
        header("Location: $url");
        die();
    }

}