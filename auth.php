<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//* controlador de autentificación de ususarios
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once("fileConfig.php");
require_once(_CLASS_DB_);
require_once(_CLASS_RESPONSE_);
require_once(_CLASS_AUTH_);

$_response = new response;
$_auth = new auth;
//solo permitimos metodos post en inicio de sesión
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $parms = file_get_contents("php://input");
    $rs = json_encode($_auth->login($parms));
    header("Content-Type: application/json");
    if(isset($rs["result"]["error_id"]))
    {//ha ido mal
        http_response_code($rs["result"]["error_id"]);
    }
    else
    {//toda ha ido bien
        http_response_code(200);
    }
    echo $rs;
}
else
{
    print_r($_response->error_405());//no es el method permitido
}
?>