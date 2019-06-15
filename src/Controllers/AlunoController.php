<?php

namespace App\Controllers;


    use Repository\Agendamento;

    class AlunoController extends ControllerManager{
    
        public function criarAgendamento(){
            if (!$this->checkRequest($this->post, array("id_personal", "id_aluno", "id_academia", "dia", "hora"))){
                return $this->badRequest();
            }

            $agendamento = new Agendamento();
            $result = $agendamento->novoAgendamento($_POST);

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function buscaAgendamento(){
            if (!$this->checkRequest($this->get, array("id", "tipo"))){
                return $this->badRequest();
            }

            $agendamento = new Agendamento();
            $result = $agendamento->buscarAgendamento($_GET["tipo"], $_GET["id"]);


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