<?php

namespace App\Controllers;


    use Repository\Treino;
    use Repository\Aparelho;
    use Repository\Exercicio;

    class PersonalController extends ControllerManager{

/* ----------------------------- EXERCICIOS ----------------------------------- */

        public function criarExercicio(){
            $result = [];

            if (!$this->checkRequest($this->post, array("nome", "series", "repeticoes", "descanso", "maquina"))){
                return $this->badRequest();
            }

            $aparelho = new Aparelho($this->post["maquina"]);

            if ($aparelho){
                $aparelho = $aparelho->getId();
            }

            if ($aparelho) {
                $exercicio = new Exercicio();
                $result = $exercicio->novoExercicio($_POST);

            }

            //$result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function buscaExercicio(){
            if (!$this->checkRequest($this->get, array("id_exercicio"))){
                return $this->badRequest();
            }

            $exercicio = new Exercicio($_GET["id_exercicio"]);
            $result = $exercicio->buscarExercicio();

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function mostrarExercicios(){
            $exercicio = new Exercicio();

            $result = $exercicio->mostrarExercicios();

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function deletarExercicio(){
            if (!$this->checkRequest($this->post, array("id_exercicio"))){
                return $this->badRequest();
            }

            $exercicio = new Exercicio($_POST["id_exercicio"]);
            $result = $exercicio->deletarExercicio();

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

/* ----------------------------- APARELHOS ----------------------------------- */

        public function buscaAparelho(){
            if (!$this->checkRequest($this->get, array("id_aparelho"))){
                return $this->badRequest();
            }

            $aparelho = new Aparelho($_GET["id_aparelho"]);
            $result = $aparelho->buscarAparelho();

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function mostrarAparelhos(){
            $aparelho = new Aparelho();

            $result = $aparelho->mostrarAparelhos();

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function adicionarAparelho(){
            $result = ["Aparelho não cadastrado"];

            if (!$this->checkRequest($this->post, array("nome", "musculo", "identificacao"))){
                return $this->badRequest();
            }

            $aparelho = new Aparelho();

            if (!$aparelho->buscarAparelhoPorNome($_POST["nome"], $_POST["identificacao"])) {
                $result = $aparelho->novoAparelho($_POST);
            }

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function deletarAparelho(){
            if (!$this->checkRequest($this->post, array("id_aparelho"))){
                return $this->badRequest();
            }

            $aparelho = new Aparelho($_POST["id_aparelho"]);
            $result = $aparelho->deletarAparelho();

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

/* ----------------------------- TREINOS ----------------------------------- */

        public function criarTreino(){
            $result = [];

            if (!$this->checkRequest($this->post, array("id_aluno", "dia") || !is_array($_POST["id_exercicio"]))){
                return $this->badRequest();
            }

            foreach ($_POST["id_exercicio"] as $key=>$id_exercicio){
                $exercicio = new Exercicio($id_exercicio);
                if ($exercicio->buscarExercicio()){
                    $treino = new Treino();
                    $result[] = $treino->novoTreino($_POST, $id_exercicio, $key + 1);
                }
            }

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function deletarTreino(){
            if (!$this->checkRequest($this->post, array("id_aluno", "dia"))){
                return $this->badRequest();
            }

            $treino = new Treino();
            $result = $treino->deletarTreino($_POST);

            $result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function buscaTreinoAluno(){
            if (!$this->checkRequest($this->get, array("id_aluno"))){
                return $this->badRequest();
            }

            $treino = new Treino();
            $result = $treino->buscarTreinoPorAluno($_GET["id_aluno"]);

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