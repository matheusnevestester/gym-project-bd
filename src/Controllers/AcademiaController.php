<?php

namespace App\Controllers;


    use Repository\Academia;

    class AcademiaController extends ControllerManager{

        public function criarAcademia(){
            if (!$this->checkRequest($this->post, array("nome", "rua", "numero", "cidade", "estado", "cep", "telefone", "email", "seg_inicio", "seg_fim", "ter_inicio", "ter_fim", "qua_inicio", "qua_fim", "qui_inicio", "qui_fim", "sex_inicio", "sex_fim", "sab_inicio", "sab_fim", "dom_inicio", "dom_fim", "feriado_inicio", "feriado_fim"))){
                return $this->badRequest();
            }

            $academia = new Academia();
            $result = $academia->novoAcademia($_POST);


            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function buscaAcademia(){
            if (!$this->checkRequest($this->get, array("id_academia"))){
                return $this->badRequest();
            }

            $academia = new Academia($_GET["id_academia"]);
            $result = $academia->buscarAcademia();

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function mostrarAcademias(){
            $academia = new Academia();

            $result = $academia->mostrarAcademias();

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function deletarAcademia(){
            if (!$this->checkRequest($this->post, array("id_academia"))){
                return $this->badRequest();
            }

            $academia = new Academia($_POST["id_academia"]);
            $result = $academia->deletarAcademia();

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }
    }