<?php 
    
    namespace Core;

    class Dispatcher {

        public function dispatch(Track $track) {
            $controller = $track->controller;
            $action = $track->action;
            $params = $track->params;
            $controller = '\\project\\controllers\\' . $controller;

            $classFile = new $controller;
            return $classFile->$action($params);
        }
    } 