<?php
ini_set("display_errors",1);

require_once( __DIR__ . '/../src/config.php');

$db_init = compact("DBTYPE","DBHOSTNAME","DBNAME","DBUSER","DBPASS");

spl_autoload_register('classAutoLoader');

function classAutoLoader($className)
{
    $path = __DIR__ . '/../src/';
    $path_to_file = $path . $className  . '.php';
    if (file_exists ($path_to_file)) {
        require_once $path_to_file;
    }
}

// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $db_conn = DBSingleton::getDbConnection($db_init);
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
    exit;
}

if (array_key_exists('HTTP_USERNAME', $_SERVER) && array_key_exists('HTTP_TOKEN', $_SERVER)) {
    try {
        $authorize = new Authorize($_SERVER['HTTP_USERNAME'], $_SERVER['HTTP_TOKEN']);
        if ( $authorize->isAuthorized() ) {
        //explode or sth
        echo "Asi jo ;)";
        }
    } catch (Exception $e) {
        echo json_encode(Array('error' => $e->getMessage()));
    }
} else {
    echo "Authenticate please!";
} 

//try {
//    $API = new MyAPI($_SERVER['REQUEST_URI'], $_SERVER['HTTP_ORIGIN']);
//    echo $API->processAPI();
//} catch (Exception $e) {
//    echo json_encode(Array('error' => $e->getMessage()));
//}
