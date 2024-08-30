<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//* controlador de la clase categoría
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once("fileConfig.php");
require_once(_CLASS_DB_);
require_once(_CLASS_RESPONSE_);
require_once(_CLASS_CATEGORIA_);
require_once(_CLASS_AUTH_);

header("Content-Type: application/json");
$_response = new response;
$_categoria = new categoria;
$_auth = new auth;

//$token = $_auth->getToken();
$token = "95ec0bb4dc49e763fe51865950d9ffce";
if($token !== false)
{
    switch($_SERVER["REQUEST_METHOD"])
    {
        case "POST"://creación de categoría
            $parms = file_get_contents("php://input");
            $rs = $_categoria->createCategoria($parms);
            break;
        case "GET":
            if(isset($_GET["page"]))
            { //listado de categorías
                $rs = $_categoria->listCategoria($_GET["page"]);        }
            elseif(isset($_GET["categoriaID"]))
            {//devolver una categoría buscada por ID               
                $rs = $_categoria->getCategoriaByID($_GET["categoriaID"]);
            }
            break;
        case "PUT"://modificación de categoría
            $parms = file_get_contents("php://input");
            $rs = $_categoria->updateCategoria($parms);
            break;
        case "DELETE"://eliminación de categoría
            $parms = file_get_contents("php://input");
            $rs = $_categoria->deleteCategoria($parms);
            break;
        default:
        echo json_encode($_response->error_405());///si se intenta otro method, enviamos error
    }
    if(isset($rs)  )
    {//si la respuesta no es vacío y no es false
        echo json_encode($rs);//si la respuesta no es vacío
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