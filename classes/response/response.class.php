<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//* clase response para devolver errores 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
class response{

    public $response = [
        "status" => "true",
        "result" => Array()
    ];

    public function error_405()
    {
        $this->response["status"] = "false";
        $this->response["result"] = Array(
            "error_id" => "405",
            "error_msg" => "Endpoint not found or not allowed",
        );
        return $this->response;
    }

    public function error_200($msg="Incorrect data")
    {
        $this->response["status"] = "false";
        $this->response["result"] = Array(
            "error_id" => "200",
            "error_msg" => $msg,
        );
        return $this->response;
    }

    public function error_400()
    {
        $this->response["status"] = "false";
        $this->response["result"] = Array(
            "error_id" => "400",
            "error_msg" => "Datos incompletos",
        );
        return $this->response;
    }

    public function error_500()
    {
        $this->response["status"] = "false";
        $this->response["result"] = Array(
            "error_id" => "500",
            "error_msg" => "Error interno del servicior",
        );
        return $this->response;
    }

    public function error_401($msg="No autorizado")
    {
        $this->response["status"] = "false";
        $this->response["result"] = Array(
            "error_id" => "401",
            "error_msg" => $msg,
        );
        return $this->response;
    }

}
?>