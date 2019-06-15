<?php

namespace Repository;

use Components\Database\MySql;

class Treino{

    private $table = "Treino";
    private $id_treino;

    function __construct($id_treino = NULL){
        $this->id_treino = $id_treino;
    }

    public function buscarTreino(){
        if (!$this->id_treino) {
            return false;
        }

        $where = array('id'=>$this->id_treino);
        $mysql = new MySql();

        $result = $mysql->select($this->table, NULL, $where);

        $mysql->close();
        return $result;
    }

    public function buscarTreinoPorAluno($id_aluno){
        if (!$id_aluno) {
            return false;
        }

        $sql = "SELECT t.*, e.nome AS nome_exercicio, e.series AS series_exercicio, e.repeticoes AS repeticoes_exercicio, e.descanso AS descanso_exercicio, a.nome AS nome_aparelho, a.identificacao AS identificacao_aparelho
                FROM ".$this->table." t INNER JOIN Exercicio e ON e.id = t.id_exercicio INNER JOIN Aparelho a ON a.id = e.maquina
                WHERE t.id_aluno = ".$id_aluno;

        $mysql = new MySql();
        $result = $mysql->executeRawSql($sql);

        $mysql->close();

        return $result;
    }

    public function novoTreino($data, $id_exercicio, $ordem = 1){
        if (!$id_exercicio || !$data['id_aluno'] || empty($data)) {
            return false;
        }

        $insert = array(
            'id_aluno'=>$data['id_aluno'],
            'id_exercicio'=>$id_exercicio,
            'dia'=>$data['dia'] ?: 'NOW()',
            'ordem'=>$ordem,
        );

        $mysql = new MySql();

        $success["result"] = $mysql->insert($this->table, $insert);
        $success["id"] = $mysql->lastId();

        $mysql->close();

        return $success;
    }

    public function deletarTreino($data){
        if (!$data['dia'] || !$data['id_aluno'] || empty($data)) {
            return false;
        }

        $where = array(
            "id_aluno"=>$data['id_aluno'],
            "dia"=>$data['dia'],
            );

        $mysql = new MySql();
        $result = $mysql->delete($this->table, $where);

        $mysql->close();
        return $result;
    }
}

?>