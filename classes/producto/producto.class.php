<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//* clase producto
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once("fileConfig.php");
require_once(_CLASS_DB_);
require_once(_CLASS_RESPONSE_);

class producto extends db
{
    public function listProducto($page = "1")
    {
        //creamos una paginación
        $ini = "0";
        $fin = "100";
        if($page > "1")
        {
            $ini = ( $fin * ($page -1)) + 1 ;
            $fin = $fin + $page;
        }
        //ejecutamos la consulta
        $sql = "SELECT * FROM producto LIMIT  ".$ini.",".$fin." ";
        $rs = parent::getSQL($sql);
        return $rs;
    }

    public function getProductoByID($productoID)
    {
        $sql = "SELECT * FROM producto WHERE id = '".$productoID."'  ";
        $rs = parent::getSQL($sql);
        return $rs;
    }

    public function createProducto($json)
    {
        $_response = new response;
        $response = $_response->response;
        $parms = json_decode($json,true);//json2array
        if(!isset($parms["nombre"]) || !isset($parms["categoriaID"])) return $_response->error_400();//si no hay nombre, faltan datos
        $sql = "INSERT INTO producto (nombre, descripcion) VALUES ('".$parms["nombre"]."','".$parms["descripcion"]."')";
        $rs = parent::insterSQL($sql);
        if($rs === false) return false;//si la sql ha ido mal, devolvemos false   
        $response["result"] = Array(
            "producto_id" => $rs,
            "msg" => "Producto creada correctamente"
        );
        return $response;//si todo ha ido bien, respuesta true
    }

    public function updateProducto($json)
    {
        $_response = new response;
        $response = $_response->response;
        $parms = json_decode($json,true);//json2array
        if(!isset($parms["nombre"]) && !isset($parms["productoID"])) return $_response->error_400();//si no hay nombre ni id, faltan datos
        $sql = "UPDATE producto SET nombre = '".$parms["nombre"]."' , descripcion = '".$parms["descripcion"]."' 
                    WHERE id = '".$parms["productoID"]."' ";
        $rs = parent::updateSQL($sql);
        if($rs === false) return false;//si la sql ha ido mal, devolvemos false   
        $response["result"] = Array(
            "producto_id" => $parms["productoID"],
            "msg" => "Producto modificada correctamente"
        );
        return $response;//si todo ha ido bien, respuesta true
    }

    public function deleteProducto($json)
    {
        $_response = new response;
        $response = $_response->response;
        $parms = json_decode($json,true);//json2array
        if(!isset($parms["productoID"])) return $_response->error_400();//si no hay id, faltan datos
        $sql = "DELETE FROM producto WHERE id = '".$parms["productoID"]."' ";
        //echo $sql;exit;
        $rs = parent::updateSQL($sql);
        if($rs === false) return false;//si la sql ha ido mal, devolvemos false   
        $response["result"] = Array(
            "producto_id" => $parms["productoID"],
            "msg" => "Producto eliminada correctamente"
        );
        return $response;//si todo ha ido bien, respuesta true
    }
}

?>