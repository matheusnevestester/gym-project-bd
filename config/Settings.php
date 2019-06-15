<?php

namespace Settings;


    class Settings{

        
        public static function getSettings(): array {
//            $str  = file_get_contents(dirname(__FILE__).'/config.json');
            return array(
                'host' => 'localhost',
                'user' => 'root',
                'password' => '123',
                'port' => '3306',
                'database' =>  'gymdb'
            );
        }
    }
