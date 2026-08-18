<?php

    namespace App\Controllers;

    class HomeController extends BaseController {

        public function __construct() {
        }

        public function index(){
            echo view('home', ['title' => 'Home Page']);
        }
        
         public function dashboard(){
            echo view('dashboard', ['title' => 'Dashboard Page']);
        }

    }