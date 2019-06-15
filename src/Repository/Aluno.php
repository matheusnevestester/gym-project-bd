<?php

namespace Repository;

use Components\Database\MySql;

class Aluno{

    private $table = "Aluno";
    private $id_aluno;
    private $id_usuario;

    function __construct($id_usuario = NULL, $id_aluno = NULL){
        $this->id_usuario = $id_usuario;
        $this->id_aluno = $id_aluno;
    }

    public function buscarAluno(){
        if (!$this->id_usuario && !$this->id_aluno) {
            return false;
        }

        $sql = "SELECT * FROM ".$this->table." a INNER JOIN Usuario u ON u.id = a.id_usuario WHERE ";

        if ($this->id_usuario){
            $sql .= "a.id_usuario = ".$this->id_usuario;
        } else{
            $sql .= "a.id = ".$this->id_aluno;
        }

        $mysql = new MySql();
        $result = $mysql->executeRawSql($sql);

        $mysql->close();
        return $result;
    }

    public function novoAluno($data = []){
        if (empty($data) || !isset($data['id_usuario'])) {
            return false;
        }

        $insert = array(
            'id_usuario'=>$data['id_usuario'],
            'objetivo'=>$data['objetivo'],
            'peso'=>$data['peso'],
            'altura'=>$data['altura'],
            'med_braco_direito'=>$data['med_braco_direito'],
            'med_braco_esquerdo'=>$data['med_braco_esquerdo'],
            'med_perna_direita'=>$data['med_perna_direita'],
            'med_perna_esquerda'=>$data['med_perna_esquerda'],
            'med_peito'=>$data['med_peito'],
            'med_abdomen'=>$data['med_abdomen']
        );

        $mysql = new MySql();

        if (isset($data["id_aluno"])){
            $success["result"] = $mysql->update($this->table, $insert, $data["id_aluno"]);
            $success["id_aluno"] = $data["id_aluno"];
        } else{
            $success["result"] = $mysql->insert($this->table, $insert);
            $success["id_aluno"] = $mysql->lastId();
        }

        $mysql->close();

        return $success;
    }
}

?>