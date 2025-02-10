<?php

namespace MVC\core;

class helpers {
    public static function redirect($url) {
        $fullURL = "http://laundry_system.com/" . $url;
        header("Location: " . $fullURL);
        exit(); // It's a good practice to add exit() after redirection to ensure no further code execution
    }
}

?>