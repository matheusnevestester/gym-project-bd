<?php

namespace App\Controllers;

    use con\ReturnMessages;

    /**
     * Classe responsável por Auxiliar os controllers.
     * 
     * @author André Gaspar <and_lrg@hotmail.com>
     */
    class ControllerManager{
        protected $get;
        protected $post;

        function __construct($get, $post){
            $this->get = $get;
            $this->post = $post;
        }
  
        protected function checkRequest($verb, $args): bool{
            foreach ($args as $arg){
                if (!isset($verb[$arg])){
                    return FALSE;
                }
            }
            return TRUE;
        }
        
        protected function success($msg=''): array{
            return array(
                'status'=>200, 
                'content'=>$msg
            );
        }

        protected function successContent($content): array{
            return array(
                'status'=>200, 
                'content'=>$content
            );
        }

        protected function badRequest(): array{
            return array(
                'status'=>400, 
                'content'=> "A requisição não possui todos os parametros necessários."
            );
        }

        protected function notAllowed(): array{
            return array(
                'status'=>403, 
                'content'=>"O Usuário não possui permissão para realizar a ação."
            );
        }
    }
