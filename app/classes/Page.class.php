<?php

class Page{    
    public static function asset($link)
    {
        $protocol = (self::isServer()) ? "https://" : "http://";  
        $host = self::getHost($protocol);  

        return $host . $link;
    }

    public static function route($uri)
    {
        $protocol =  (self::isServer()) ? "https://" : "http://";  
        $host = self::getHost($protocol);  

        header('Location: '. $host . $uri);
        exit();
    }

    public static function getCurrentURI()
    {
        $protocol = (self::isServer()) ? "https://" : "http://";
 
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $url;
    }

    private static function isServer()
    {
        return ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443);
    }

    private static function getHost($protocol){        
        if(self::isServer()){                    
            return $protocol . $_SERVER['HTTP_HOST'] . '/ucc-admission';
        }else{
            return $protocol . $_SERVER['HTTP_HOST'] . '/ucc-admission'; 
        }
    }
}