<?php

    namespace Project\Controllers;

    use Core\Controller;
    class HomeController extends Controller
    {
        public function index()
        {
            return $this->render('home/index',[]);     
        }
    }