<?php

namespace Repository;

use Components\Database\MySql;

class Aparelho{

    private $table = "Aparelho";
    private $id_aparelho;

    function __construct($id_aparelho = NULL){
        $this->id_aparelho = $id_aparelho;
    }

    public function getId(){
        return $this->id_aparelho;
    }

    public function buscarAparelho(){
        if (!$this->id_aparelho) {
            return false;
        }

        $where = array('id'=>$this->id_aparelho);
        $mysql = new MySql();

        $result = $mysql->select($this->table, NULL, $where);

        $mysql->close();
        return $result;
    }

    public function novoAparelho($data){
        $insert = array(
            'nome'=>$data['nome'],
            'musculo'=>$data['musculo'],
            'identificacao'=>$data['identificacao'],
        );

        $mysql = new MySql();

        if (isset($data["id_aparelho"])){
            $success["result"] = $mysql->update($this->table, $insert, $data["id_aparelho"]);
            $success["id"] = $data["id_aparelho"];
        } else{
            $success["result"] = $mysql->insert($this->table, $insert);
            $success["id"] = $mysql->lastId();
        }

        $mysql->close();

        return $success;
    }

    public function mostrarAparelhos(){
        $mysql = new MySql();

        $result = $mysql->select($this->table, null, null);

        $mysql->close();
        return $result;
    }

    public function deletarAparelho(){
        if (!$this->id_aparelho) {
            return false;
        }

        $where = array("id"=>$this->id_aparelho);

        $mysql = new MySql();
        $result = $mysql->delete($this->table, $where);

        $mysql->close();
        return $result;
    }

    public function buscarAparelhoPorNome($nome, $ref = ""){
        $field = array('*');
        $where = array('nome'=>$nome);

        if (!empty($ref)){
            $where["identificacao"] = $ref;
        }

        $mysql = new MySql();

        $result = $mysql->select($this->table, $field, $where);

        $mysql->close();
        return $result;
    }

}

?>