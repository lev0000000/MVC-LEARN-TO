<?php 

    namespace PHPFramework;

    class Application {
        public static ?Application $app; // Статичная переменная для хелпера, чтобы можно было обращаться к ней без создания нового экземляра. 
        protected string $uri; 
        public Request $request;

        public Response $response;

        public Router $router;

        public View $view;

        public function __construct()
        {
            self::$app = $this; 
            $this->uri = $_SERVER['REQUEST_URI']; 
            $this->request = new Request($this->uri); // обработка запроса создает экз класса 
            $this->response = new Response(); // экз класса ответчика по запросу 
            $this->router = new Router($this->request, $this->response); // экз класса роутинга передает туда созданные классы выше 
            $this->view = new View(LAYOUT);
        }

        public function run()
        {
            return $this->router->dispatch(); // из index вызываем диспатч из класса роутинга 
        }

    }