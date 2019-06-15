<?php

namespace Components\Router;

    define("GET", "GET");
    define("POST", "POST");
    define("CONTROLLER", "App\Controllers");
    
    /**
     * Classe responsável pelo gerenciamento de rotas.
     * 
     * @author André Gaspar
     */
    class Router {
        
        private static $getroutes = array();
        private static $postroutes = array();
        
        /**
         * Função responsável por cadastrar as rotas.
         *
         * @param string $verb GET ou POST.
         * @param string $pattern Padrão da rota;
         * @param string $class Nome da classe a ser instanciada para o 
         * controller da rota.
         * @param string $method Método a ser chamado.
         * 
         * @return void
         */
        public static function route($verb, $pattern, $class, $method) {
            $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
            $infos = array(
                "class"  => $class,
                "method" => $method
            );
            if ($verb == GET){
                self::$getroutes[$pattern] = $infos;
            }else if ($verb == POST){
                self::$postroutes[$pattern] = $infos;
            }
        }
        
        /**
         * Função responsável por tratar a requisição redirecionando para rota
         * Correta
         *
         * @param string $url URL da requisição.
         * @param string $rMethod Método da requisição.
         * 
         * @return JSON com as informaçoes caso a requisição tenha sido bem 
         * sucedida, caso esjeta faltando informaçoes, e 404 caso a rota não 
         * exista.
         */
        public static function execute($url, $rMethod) {
            if ($rMethod == GET){
                $routes = self::$getroutes;
            }
            if ($rMethod == POST){
                $routes = self::$postroutes;
            }
            $url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
            
            foreach ($routes as $pattern => $infos) {
                if (preg_match($pattern, $url)) {
                    $class = sprintf("%s\%s", CONTROLLER, $infos['class']);
                    $method = $infos['method'];
                    $requestResult = (new $class($_GET, $_POST))->$method();
                    header('Content-Type: application/json');
                    http_response_code($requestResult['status']);
                    return json_encode($requestResult['content']);
                }
            }

            return http_response_code(404);
        }
    }
