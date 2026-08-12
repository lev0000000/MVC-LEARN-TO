<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    public function register(){
        
        echo view('user/register', ['title' => 'Register Page']);    
    }

    public function store(){
        $model = new User();
        $model->loadData();
        if(!$model->validate()){
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        }else{
            session()->setFlash('info', 'Info message');
            session()->setFlash('success', 'User created');
        }

        response()->redirect('/register/');
        // dump($model->validate());
        // dump($model->getErrors());
        // dd($model->attributes);
    }

    public function login(){
        
        echo view('user/login', ['title' => 'Login Page']);
    
    }
}