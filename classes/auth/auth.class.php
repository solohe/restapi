<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//* clase auth para la autenticación se usuarios y insert y update de token 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once("fileConfig.php");
require_once(_CLASS_DB_);
require_once(_CLASS_RESPONSE_);

class auth extends db
{
    public function login($json)
    {
        $_response = new response;
        $parms = json_decode($json,true);
        if(!isset($parms["user"]) || !isset($parms["password"])) return $_response->error_400();//si no hay parametros error
        $user = $this->authUser($parms);
        if($user === false) return $_response->error_200("Usuario no encontrado");
        if($user["level"] != '0') return $_response->error_200("El usuario no tiene permiso de acceso");
        $token = $this->setToken($user["id"]);//creamos un token
        if($token === false) return $_response->error_500();//ha ido mal, devolvemos error
        $rs = $_response->response;//ha ido bien, devolvemos token
        $rs["result"] = Array(
            "token" => $token,
            "user" => $user["user"]
        );
        return $rs;
    }

    private function authUser($parms)
    {//función que busca si existe el usuario insertado
        $sql = "SELECT * FROM users WHERE user = '".$parms["user"]."' AND password = '".$parms["password"]."' ";
        $rs = parent::getSQL($sql);
        if(isset($rs[0]["id"])) return $rs[0];
        return false;
    }

    private function setToken($userID)
    {//función que crea e inserta el token en la db 'token'
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
        $datetime = Date("Y-m-d H:i:s");
        $status = "active";
        $sql = "INSERT INTO token (userID,token,status,datetime) VALUES ('".$userID."','".$token."','".$status."','".$datetime."')";
        $rs = parent::insterSQL($sql);
        if($rs !== false) return $token;
        return false;
    }

    public function getToken()
    {//comprobación de que el token recivido existe
        $token = "";
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {//si los datos de envian por get
           if(isset($_GET["token"])) $token = $_GET["token"];
        }
        else
        {//si no los datos son enviados por post/put/delete
            $json = file_get_contents("php://input");
            $parms = json_decode($json,true);//json2array
            if(isset($parms["token"]) )$token = $parms["token"];
        }
        if(!isset($token)) return false;
        $sql = "SELECT * FROM token WHERE token = '".$token."' AND status = 'active' ";
        $rs = parent::getSQL($sql);
        if(isset($rs[0]["token"])) return $rs[0]["token"];
        return false;
    }
}
?>