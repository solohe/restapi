<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//* clase db para la conexión a la base de datos y ejecución de sqls
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
class db{
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $db;

    function __construct()
    {//construcción de la clase de db
        $configDbA = $this->getDataConection();
        foreach($configDbA as $index => $value)
        {
            $this->server = $value["server"];
            $this->user = $value["user"];
            $this->password = $value["password"];
            $this->database = $value["database"];
            $this->port = $value["port"];
        }
        $this->db = new mysqli( $this->server, $this->user, $this->password, $this->database, $this->port);
        if($this->db->connect_errno)
        {
            echo "Error de conexión a base de datos";
            exit;
        }
        else
        {//todo ha ido bien
        }
    }

    private function getDataConection()
    {//coge los parámetros de configuración y los devuelve en array
        $dir = dirname(__FILE__);
        $json = file_get_contents($dir."/config");
        $rs = json_decode($json,true);
        return $rs;
    }

    private function convertUTF8($array)
    {//enconde utf8 para extracción de datos de db
        array_walk_recursive($array, function(&$data,$key){
            if(!mb_detect_encoding($data,"utf-8",true))
            {
                $data = utf8_decode($data);//no funciona, no he encontrado el porque
            }
        });
        return $array;
    }

    public function getSQL($strQuery)
    {//para devolver datos de db
       // $result = $this->db->query($strQuery)->fetch_object();
        //return $this->convertUTF8();
        $result = $this->db->query($strQuery);
        $resultA = Array();
        foreach($result as $rs)
        {
            $resultA[] = $rs;
        }
        return $this->convertUTF8($resultA);
    }

    public function insterSQL($strSQL)
    {//para insertar datos en db y devolver id creado
        $result = $this->db->query($strSQL);
        $num_rows = $this->db->affected_rows;
        if($num_rows == '1') return $this->db->insert_id;
        return false;
    }

    public function updateSQL($strSQL)
    {//para las funciones de actualización que no necesitamos que devuelva el id
        $result = $this->db->query($strSQL);
        return $this->db->affected_rows;
    }
}
?>