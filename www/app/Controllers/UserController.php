<?php

namespace App\Controllers;

use App\Models\User;

use Illuminate\Database\Capsule\Manager as Capsule;

class UserController extends BaseController
{
    public function register(){
        $users = Capsule::table('users')->get();
        // $users = Capsule::select('select * from users where id = ?', [1]);

        // dump(Capsule::insert('insert into users (name,email,password) values (?,?,?)',['Lev','bogatov2002@list.ru','1234566']));
        $users2 = User::query()->where('id',3)->get();
        foreach($users2 as $user){
            dump($user->name);
        }

        
        // dump($users);
        echo view('user/register', [
            'title' => 'Register Page',
            'users' => $users
            ]);    
    }

    public function store(){
        $model = new User();
        $model->loadData();
        if(!$model->validate()){
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        }else{
            dd($model->attributes);
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