<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//* controlador de la clase producto
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once("fileConfig.php");
require_once(_CLASS_DB_);
require_once(_CLASS_RESPONSE_);
require_once(_CLASS_PRODUCTO_);
require_once(_CLASS_AUTH_);

header("Content-Type: application/json");
$_response = new response;
$_producto = new producto;
$_auth = new auth;
//95ec0bb4dc49e763fe51865950d9ffce
//$token = $_auth->getToken();//en el token, se debe programar un cron en el servidor para desactivarlo
$token = "95ec0bb4dc49e763fe51865950d9ffce";
if($token !== false)
{
    switch($_SERVER["REQUEST_METHOD"])
    {
        case "POST"://creación de producto
            $parms = file_get_contents("php://input");
            $rs = $_producto->createProducto($parms);
            break;
        case "GET":
            if(isset($_GET["page"]))
            { //listado de producto
                $rs = $_producto->listProducto($_GET["page"]);        }
            elseif(isset($_GET["productoID"]))
            {//devolver un producto buscada por ID               
                $rs = $_producto->getProductoByID($_GET["productoID"]);
            }
            break;
        case "PUT"://modificar producto
            $parms = file_get_contents("php://input");
            $rs = $_producto->updateProducto($parms);
            break;
        case "DELETE"://eliminar producto
            $parms = file_get_contents("php://input");
            $rs = $_producto->deleteProducto($parms);
            break;
        default:
        echo json_encode($_response->error_405());//si se intenta otro method, enviamos error
    }
    if(isset($rs)  )
    {//si la respuesta no es vacío
        echo json_encode($rs);//enviamos info
        http_response_code(200);//estado 200
    }
    else
    {//la respuesta es vacía
        echo json_encode($_response->error_500());//enviamos error
        http_response_code(500);//estado 500
    }
}
else
{//no existe es token
    echo json_encode($_response->error_401());
    http_response_code(401); 
}

?>