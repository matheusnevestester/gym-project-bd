<?php

namespace App\Controllers;


    use Repository\Usuario;
    use Repository\Aluno;
    use Repository\Personal;

    class AccountController extends ControllerManager{
    
        public function ario(){
            $result = [];

            if (!$this->checkRequest($this->post, array("nome", "sobrenome", "email", "senha", "telefone", "rua", "numero", "cep", "cidade", "estado", "sexo"))){
                return $this->badRequest();
            }

            $usuario = new Usuario();

            if (!$usuario->buscarUsuarioPorEmail($_POST["email"]) || isset($_POST["id_usuario"])) {

                switch ($_POST["tipo"]){
                    case "aluno":
                        if (!$this->checkRequest($this->post, array("objetivo", "peso", "altura", "med_braco_direito", "med_braco_esquerdo", "med_perna_direita", "med_perna_esquerda", "med_peito", "med_abdomen"))){
                            return $this->badRequest();
                        }
                        $resultUsuario = $usuario->novoUsuario($_POST);

                        if ($resultUsuario["id"]) {
                            $_POST["id_usuario"] = $resultUsuario["id"];
                            $aluno = new Aluno($resultUsuario["id"]);

                            if (!$aluno->buscarAluno() || isset($_POST["id_usuario"])) {
                                $result = $aluno->novoAluno($_POST);
                                $result["id_usuario"] = $resultUsuario["id"];
                            }
                        }
                        break;
                    case "personal":
                        if (!$this->checkRequest($this->post, array("especializacao", "tempo_experiencia"))){
                            return $this->badRequest();
                        }
                        $resultUsuario = $usuario->novoUsuario($_POST);

                        if ($resultUsuario["id"]) {
                            $_POST["id_usuario"] = $resultUsuario["id"];
                            $personal = new Personal($result["id"]);

                            if (!$personal->buscarPersonal() || isset($_POST["id_usuario"])) {
                                $result = $personal->novoPersonal($_POST);
                                $result["id_usuario"] = $resultUsuario["id"];
                            }
                        }
                        break;
                    default:
                        break;
                }
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

        public function buscaUsuario(){
            $result = [];
            if (!$this->checkRequest($this->get, array("id_usuario", "tipo"))){
                return $this->badRequest();
            }

            if ($_GET["tipo"] == "aluno"){
                $aluno = new Aluno($_GET["id_usuario"]);
                $result = $aluno->buscarAluno();
            } elseif ($_GET["tipo"] == "personal"){
                $personal = new Personal($_GET["id_usuario"]);
                $result = $personal->buscarPersonal();
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

        public function buscaAlunos(){

            $usuario = new Usuario();
            $result = $usuario->buscarAlunos();

            //$result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;

        }

        public function buscaUsuarioTipo(){
            if (!$this->checkRequest($this->get, array("id_usuario", "tipo"))){
                return $this->badRequest();
            }

            $usuario = new Usuario($_GET["id_usuario"]);
            $result = $usuario->buscarUsuarioPorTipo($_GET["tipo"]);

            //$result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;

        }

        public function login(){
            $return = [];
            if (!$this->checkRequest($this->get, array("email", "senha"))){
                return $this->badRequest();
            }

            $senha = md5($_GET["senha"]);

            $usuario = new Usuario();

            if ($result = $usuario->login($_GET["email"], $senha)){
                $return["user_id"] = $result[0]["id"];

                $personal = new Personal($result[0]["id"]);
                $aluno = new Aluno($result[0]["id"]);

                if ($personal->buscarPersonal()){
                    $return["tipo"] = "personal";
                } elseif ($aluno->buscarAluno()){
                    $return["tipo"] = "aluno";
                }
            }

            //$return = mb_convert_encoding($return,"UTF-8","auto");
            $return = json_encode($return, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

        public function deletarUsuario(){
            if (!$this->checkRequest($this->post, array("id_usuario"))){
                return $this->badRequest();
            }

            $usuario = new Usuario($_POST["id_usuario"]);
            $result = $usuario->deletarUsuario();

            //$result = mb_convert_encoding($result,"UTF-8","auto");
            $return = json_encode($result, JSON_UNESCAPED_UNICODE);

            if ($return){
                echo $return;
                exit;
            }
            echo json_last_error_msg();
            exit;
        }

    }