<?php

namespace Repository;

use Components\Database\MySql;

class Exercicio{

    private $table = "Exercicio";
    private $id_exercicio;

    function __construct($id_exercicio = NULL){
        $this->id_exercicio = $id_exercicio;
    }

    public function buscarExercicio(){
        if (!$this->id_exercicio) {
            return false;
        }

        $sql = "SELECT e.*, a.nome AS nome_aparelho, a.identificacao AS identificacao_aparelho, a.musculo FROM ".$this->table." e INNER JOIN Aparelho a ON a.id = e.maquina WHERE e.id = ".$this->id_exercicio;


        $mysql = new MySql();
        $result = $mysql->executeRawSql($sql);

        $mysql->close();

        return $result;
    }

    public function novoExercicio($data){
        $success = false;

        $insert = array(
            'nome'=>$data['nome'],
            'series'=>$data['series'],
            'repeticoes'=>$data['repeticoes'],
            'descanso'=>$data['descanso'],
            'maquina'=>$data['maquina'],
        );

        $mysql = new MySql();

        if (isset($data["id_exercicio"])){
            $success["result"] = $mysql->update($this->table, $insert, $data["id_exercicio"]);
            $success["id"] = $data["id_exercicio"];
        } else{
            $success["result"] = $mysql->insert($this->table, $insert);
            $success["id"] = $mysql->lastId();
        }

        $mysql->close();

        return $success;
    }

    public function mostrarExercicios(){

        $sql = "SELECT e.*, a.nome AS nome_aparelho, a.identificacao AS identificacao_aparelho, a.musculo FROM ".$this->table." e INNER JOIN Aparelho a ON a.id = e.maquina";

        $mysql = new MySql();
        $result = $mysql->executeRawSql($sql);

        $mysql->close();

        return $result;
    }

    public function deletarExercicio(){
        if (!$this->id_exercicio) {
            return false;
        }

        $where = array("id"=>$this->id_exercicio);

        $mysql = new MySql();
        $result = $mysql->delete($this->table, $where);

        $mysql->close();
        return $result;
    }

    public function buscarExercicioPorNome($nome){
        $field = array('*');
        $where = array('nome'=>$nome);
        $mysql = new MySql();

        $success = $mysql->select($this->table, $field, $where);
        $mysql->close();

        return $success;
    }

}

?>