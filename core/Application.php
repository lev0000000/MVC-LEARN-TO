<?php 

    namespace PHPFramework;

    class Application {
        public static ?Application $app;
        protected string $uri;
        public Request $request;

        public Response $response;

        public Router $router;


        public function __construct()
        {
            self::$app = $this;
            $this->uri = $_SERVER['REQUEST_URI'];
            $this->request = new Request($this->uri);
            $this->response = new Response();
            $this->router = new Router($this->request, $this->response);
        }

        public function run()
        {
            echo $this->router->dispatch();
        }

    }