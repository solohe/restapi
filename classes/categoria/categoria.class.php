<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//* clase categoría
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once("fileConfig.php");
require_once(_CLASS_DB_);
require_once(_CLASS_RESPONSE_);

class categoria extends db
{
    public function listCategoria($page = "1")
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
        $sql = "SELECT * FROM categoria LIMIT  ".$ini.",".$fin." ";
        $rs = parent::getSQL($sql);
        return $rs;
    }

    public function getCategoriaByID($categoriaID)
    {//devuelve la categoría buscada por su id
        $sql = "SELECT * FROM categoria WHERE id = '".$categoriaID."'  ";
        $rs = parent::getSQL($sql);
        return $rs;
    }

    public function createCategoria($json)
    {//insert de creación de categoría
        $_response = new response;
        $response = $_response->response;
        $parms = json_decode($json,true);//json2array
        if(!isset($parms["nombre"])) return $_response->error_400();//si no hay nombre, faltan datos
        $sql = "INSERT INTO categoria (nombre, descripcion) VALUES ('".$parms["nombre"]."','".$parms["descripcion"]."')";
        $rs = parent::insterSQL($sql);
        if($rs === false) return false;//si la sql ha ido mal, devolvemos false   
        $response["result"] = Array(
            "categoria_id" => $rs,
            "msg" => "Categoría creada correctamente"
        );
        return $response;//si todo ha ido bien, respuesta true
    }

    public function updateCategoria($json)
    {//actualización de datos de una categoría
        $_response = new response;
        $response = $_response->response;
        $parms = json_decode($json,true);//json2array
        if(!isset($parms["nombre"]) && !isset($parms["categoriaID"])) return $_response->error_400();//si no hay nombre ni id, faltan datos
        $sql = "UPDATE categoria SET nombre = '".$parms["nombre"]."' , descripcion = '".$parms["descripcion"]."' 
                    WHERE id = '".$parms["categoriaID"]."' ";
        $rs = parent::updateSQL($sql);
        if($rs === false) return false;//si la sql ha ido mal, devolvemos false   
        $response["result"] = Array(
            "categoria_id" => $parms["categoriaID"],
            "msg" => "Categoría modificada correctamente"
        );
        return $response;//si todo ha ido bien, respuesta true
    }

    public function deleteCategoria($json)
    {//eliminación de categoría
        $_response = new response;
        $response = $_response->response;
        $parms = json_decode($json,true);//json2array
        if(!isset($parms["categoriaID"])) return $_response->error_400();//si no hay id, faltan datos
        $sql = "DELETE FROM categoria WHERE id = '".$parms["categoriaID"]."' ";
        $rs = parent::updateSQL($sql);
        if($rs === false) return false;//si la sql ha ido mal, devolvemos false   
        $response["result"] = Array(
            "categoria_id" => $parms["categoriaID"],
            "msg" => "Categoría eliminada correctamente"
        );
        return $response;//si todo ha ido bien, respuesta true
    }
}

?>