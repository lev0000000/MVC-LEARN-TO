<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function register(){
        
        echo view('user/register', ['title' => 'Register Page']);
    
    }

    public function login(){
        
        echo view('user/login', ['title' => 'Login Page']);
    
    }
}