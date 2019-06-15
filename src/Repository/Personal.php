<?php

namespace Repository;

use Components\Database\MySql;

class Personal{

    private $table = "Personal";
    private $id_personal;
    private $id_usuario;

    function __construct($id_usuario = NULL, $id_personal = NULL){
        $this->id_usuario = $id_usuario;
        $this->id_personal = $id_personal;
    }

    public function buscarPersonal(){
        if (!$this->id_usuario && !$this->id_personal) {
            return false;
        }

        $sql = "SELECT * FROM ".$this->table." p INNER JOIN Usuario u ON u.id = p.id_usuario WHERE ";

        if ($this->id_usuario){
            $sql .= "p.id_usuario = ".$this->id_usuario;
        } else{
            $sql .= "p.id = ".$this->id_personal;
        }

        $mysql = new MySql();
        $result = $mysql->executeRawSql($sql);

        $mysql->close();
        return $result;
    }

    public function novoPersonal($data = []){
        if (empty($data) || !isset($data['id_usuario'])) {
            return false;
        }

        $insert = array(
            'id_usuario'=>$data['id_usuario'],
            'especializacao'=>$data['especializacao'],
            'tempo_experiencia'=>$data['tempo_experiencia']
        );

        $mysql = new MySql();

        if (isset($data["id_personal"])){
            $success["result"] = $mysql->update($this->table, $insert, $data["id_personal"]);
            $success["id_personal"] = $data["id_personal"];
        } else{
            $success["result"] = $mysql->insert($this->table, $insert);
            $success["id_personal"] = $mysql->lastId();
        }
        $mysql->close();

        return $success;
    }
}

?>