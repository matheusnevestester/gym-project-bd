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
            'seg_inicio'=>$data['seg_inicio'],
            'seg_fim'=>$data['seg_fim'],
            'ter_inicio'=>$data['ter_inicio'],
            'ter_fim'=>$data['ter_fim'],
            'qua_inicio'=>$data['qua_inicio'],
            'qua_fim'=>$data['qua_fim'],
            'qui_inicio'=>$data['qui_inicio'],
            'qui_fim'=>$data['qui_fim'],
            'sex_inicio'=>$data['sex_inicio'],
            'sex_fim'=>$data['sex_fim'],
            'sab_inicio'=>$data['sab_inicio'],
            'sab_fim'=>$data['sab_fim'],
            'dom_inicio'=>$data['dom_inicio'],
            'dom_fim'=>$data['dom_fim'],
            'feriado_inicio'=>$data['feriado_inicio'],
            'feriado_fim'=>$data['feriado_fim'],
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