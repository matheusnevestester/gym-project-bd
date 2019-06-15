<?php

namespace App\Controllers;


    class HeartbeatController extends ControllerManager{
    
        public function ping(){
            return $this->success('I`m alive!');
        }
    }