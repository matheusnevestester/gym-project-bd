<?php

namespace Repository;

use Components\Database\MySql;

class Academia{

    private $table = "Academia";
    private $id_academia;

    function __construct($id_academia = NULL){
        $this->id_academia = $id_academia;
    }

    public function buscarAcademia(){
        if (!$this->id_academia) {
            return false;
        }

        $where = array('id'=>$this->id_academia);
        $mysql = new MySql();

        $success = $mysql->select($this->table, null, $where);
        $mysql->close();

        return $success;
    }

    public function novoAcademia($data){
        $success = false;

        $insert = array(
            'nome'=>$data['nome'],
            'rua'=>$data['rua'],
            'numero'=>$data['numero'],
            'cidade'=>$data['cidade'],
            'estado'=>$data['estado'],
            'cep'=>$data['cep'],
            'telefone'=>$data['telefone'],
            'email'=>$data['email'],
            'horario_abre'=>$data['horario_abre'],
            'horario_fecha'=>$data['horario_fecha'],
    
        );

        $mysql = new MySql();

        if (isset($data["id_academia"])){
            $success["result"] = $mysql->update($this->table, $insert, $data["id_academia"]);
            $success["id"] = $data["id_academia"];
        } else{
            $success["result"] = $mysql->insert($this->table, $insert);
            $success["id"] = $mysql->lastId();
        }

        $mysql->close();

        return $success;
    }

    public function mostrarAcademias(){

        $mysql = new MySql();

        $success = $mysql->select($this->table, null, null);
        $mysql->close();

        return $success;
    }

    public function deletarAcademia(){
        if (!$this->id_academia) {
            return false;
        }

        $where = array("id"=>$this->id_academia);

        $mysql = new MySql();
        $result = $mysql->delete($this->table, $where);

        $mysql->close();
        return $result;
    }

}

?>