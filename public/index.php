<?php

namespace MVC\core;
define("DS",DIRECTORY_SEPARATOR);
define("ROOT",dirname(__DIR__).DS);
define("APP",ROOT."app".DS);
define("CONTROLLER",APP."controllers".DS);
define("CORE",APP."core".DS);
define("MODEL",APP."models".DS);
define("VIEW",APP."views".DS);
define("CONFIG",APP."config".DS);


// config 
define("SERVER","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","laundry_system");
define("DATABASE_TYPE","mysql");
define("path","http://laundry_system.com/");

require_once ("../vendor/autoload.php");


use MVC\core\app; // Ensure this line exists and matches the namespace
$app = new app();
