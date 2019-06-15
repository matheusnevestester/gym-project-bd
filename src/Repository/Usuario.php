<?php

namespace Repository;

use Components\Database\MySql;

class Usuario{

    private $table = "Usuario";
    private $id_usuario;

    function __construct($id_usuario = NULL){
        $this->id_usuario = $id_usuario;
    }

    public function buscarUsuario(){
        if (!$this->id_usuario) {
            return false;
        }

        $where = array('id'=>$this->id_usuario);
        $mysql = new MySql();

        $result = $mysql->select($this->table, NULL, $where);

        $mysql->close();
        return $result;
    }

    public function buscarAlunos(){

        $sql = "SELECT a.*, u.nome, u.sobrenome FROM ".$this->table." u INNER JOIN Aluno a ON a.id_usuario = u.id";

        $mysql = new MySql();
        $result = $mysql->executeRawSql($sql);

        $mysql->close();

        return $result;
    }

    public function buscarUsuarioPorTipo($tipo){
        if (!$tipo && !$this->id_usuario) {
            return false;
        }

        if ($tipo == "aluno"){
            $sql = "SELECT a.*, u.nome, u.sobrenome, u.email, u.telefone, u.rua, u.numero, u.cep, u.cidade, u.estado, u.sexo FROM ".$this->table." u INNER JOIN Aluno a ON a.id_usuario = u.id WHERE u.id = ".$this->id_usuario;
        } elseif ($tipo == "personal"){
            $sql = "SELECT p.*, u.nome, u.sobrenome, u.email, u.telefone, u.rua, u.numero, u.cep, u.cidade, u.estado, u.sexo FROM ".$this->table." u INNER JOIN Personal p ON p.id_usuario = u.id WHERE u.id = ".$this->id_usuario;
        }

        $mysql = new MySql();
        $result = $mysql->executeRawSql($sql);

        $mysql->close();

        return $result;
    }

    public function buscarUsuarioPorEmail($email){
        if (!$email) {
            return false;
        }
        $field = array('*');
        $where = array('email' => $email);

        $mysql = new MySql();

        $success = $mysql->select($this->table, $field, $where);
        $mysql->close();

        return $success;
    }

    public function novoUsuario($data = []){
        if (empty($data)) {
            return false;
        }

        $insert = array(
            'nome'=>$data['nome'],
            'sobrenome'=>$data['sobrenome'],
            'email'=>$data['email'],
            'senha'=>$data['senha'] ? md5($data['senha']) : md5('abc123'),
            'telefone'=>$data['telefone'],
            'rua'=>$data['rua'],
            'numero'=>$data['numero'],
            'cep'=>$data['cep'],
            'cidade'=>$data['cidade'],
            'estado'=>$data['estado'],
            'sexo'=>$data['sexo'],
        );

        $mysql = new MySql();

        if (isset($data["id_usuario"])){
            $success["result"] = $mysql->update($this->table, $insert, $data["id_usuario"]);
            $success["id"] = $data["id_usuario"];
        } else{
            $success["result"] = $mysql->insert($this->table, $insert);
            $success["id"] = $mysql->lastId();
        }

        $mysql->close();

        return $success;
    }

    public function login($email, $senha){
        if (!$email || !$senha) {
            return false;
        }
        $field = array('id');
        $where = array('email' => $email,
                        'senha' => $senha);

        $mysql = new MySql();

        $success = $mysql->select($this->table, $field, $where);
        $mysql->close();

        return $success;
    }

    public function deletarUsuario(){
        if (!$this->id_usuario) {
            return false;
        }

        $where = array("id"=>$this->id_usuario);

        $mysql = new MySql();
        $result = $mysql->delete($this->table, $where);

        $mysql->close();
        return $result;
    }
}

?>