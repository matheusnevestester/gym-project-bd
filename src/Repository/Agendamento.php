<?php

namespace Repository;

use Components\Database\MySql;

class Agendamento{

    private $table = "Agendamento";
    private $id_aluno;
    private $id_personal;

    function __construct($id_personal = NULL, $id_aluno = NULL){
        $this->id_personal = $id_personal;
        $this->id_aluno = $id_aluno;
    }

    public function buscarAgendamento($tipo, $id){
        $where = "";
        if ($tipo == "aluno"){
            $where = "WHERE agend.id_aluno = ".$id;
        }elseif ($tipo == "personal"){
            $where = "WHERE agend.id_personal = ".$id;
        }

        $sql = "SELECT ua.nome AS nome_aluno, ua.sobrenome AS sobrenome_aluno, ua.email AS email_aluno, ua.telefone AS telefone_aluno,
                up.nome AS nome_personal, up.sobrenome AS sobrenome_personal, up.email AS email_personal, up.telefone AS telefone_personal,
                acad.nome AS nome_academia, acad.rua AS rua_academia, acad.numero AS numero_academia, acad.cidade AS cidade_academia, acad.estado AS estado_academia
                FROM ".$this->table." agend INNER JOIN Aluno a ON a.id = agend.id_aluno INNER JOIN Usuario ua ON ua.id = a.id_usuario
                INNER JOIN Personal p ON p.id = agend.id_personal INNER JOIN Usuario up ON up.id = p.id_usuario
                INNER JOIN Academia acad ON acad.id = agend.id_academia ".$where;

        $mysql = new MySql();
        $result = $mysql->executeRawSql($sql);

        $mysql->close();
        return $result;
    }

    public function novoAgendamento($data = []){
        if (empty($data) || !isset($data['id_personal']) || !isset($data['id_aluno']) || !isset($data['id_academia'])) {
            return false;
        }

        $insert = array(
            'id_personal'=>$data['id_personal'],
            'id_aluno'=>$data['id_aluno'],
            'id_academia'=>$data['id_academia'],
            'dia'=>$data['dia'],
            'hora'=>$data['hora']
        );

        $mysql = new MySql();

        $success = $mysql->insert($this->table, $insert);
        $mysql->close();

        return $success;
    }
}

?>