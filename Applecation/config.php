<?php

//define database variables
define('DSN',"mysql:host=localhost;dbname=scandiWeb;charset=utf8mb4;port=3306");
define('USER_NAME','root');
define('PASSWORD','');


define('LIBERARY_NAMESPACE',"Applecation".DIRECTORY_SEPARATOR."Liberary");
define('DBCONNECTION_NAMESPACE',LIBERARY_NAMESPACE.DIRECTORY_SEPARATOR.'DBConnection');
define('PRODUCT_NAMESPACE',LIBERARY_NAMESPACE.DIRECTORY_SEPARATOR.'Product');
define('PRODUCT_VALID_NAMESPACE',LIBERARY_NAMESPACE.DIRECTORY_SEPARATOR.'Validation'.DIRECTORY_SEPARATOR.'Products');
define('CONTROLLER_NAMESPACE',"Applecation".DIRECTORY_SEPARATOR."Controllers");
define('MODEL_NAMESPACE',"Applecation".DIRECTORY_SEPARATOR."Models");

define('VIEWURL','http://localhost/scandiWeb/'.'Applecation'.'/'.'Views');
define('CSSURL','http://localhost/scandiWeb/'.'Public'.'/'.'CSS');
define('JSURL','http://localhost/scandiWeb/'.'Public'.'/'.'JS');

define('SESSION_TIME_OUT',60*60);
?>