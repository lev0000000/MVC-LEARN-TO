<?php

namespace App\Controllers;

use App\Models\User;

use Illuminate\Database\Capsule\Manager as Capsule;

class UserController extends BaseController
{
    public function register(){
        // Capsule::enableQueryLog();
        // $users = User::query()->with('phones')->find(1);
        // dump($users);
        // dump(Capsule::getQueryLog());

        // $users = Capsule::select('select * from users where id = ?', [1]);

        // dump(Capsule::insert('insert into users (name,email,password) values (?,?,?)',['Lev','bogatov2002@list.ru','1234566']));
        // $users2 = User::query()->where('id',3)->get();

        // $user = db()->query('select * from users where id > ?', [2])->getOne();

        // $user = db()->query('select count(*) from users')->getColumn();

        // $user = db()->findAll('users');

        // $user = db()->findOrFailed('users',2);

        // db()->query('insert into phones (user_id,phone) values(?,?)',[5,'+43443']);

        // db()->query("delete from phones where id < ?", [3]);
        // dump(db()->rowCount());

       try{
         db()->beginTransaction();
         db()->query("insert into phones (user_id,phone) value (?,?)", [9,"+324422"]);
         db()->query("insert into users (name,email,password) value (?,?,?)", ['Alex',"alex@mail.com", '11111']);
         db()->commit();
        }
       catch(\PDOException $e){
        error_log("[" . date("Y-m-d H:i:s") . "] DB Error:
        {$e->getMessage()}" . PHP_EOL, 3, ERROR_LOGS);         
        db()->rollback();
       }
        

        
        // dump($users);
        echo view('user/register', [
            'title' => 'Register Page',
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
            // dump(User::query()->create([
            //     'name' => $model->attributes['name'],
            //     'email'=> $model->attributes['email'],
            //     'password'=> $model->attributes['password'],
            // ]));
            if($model->save()){
                session()->setFlash('success','Thanks for registration');
            }else{
                session()->setFlash('error', 'Validation errors');
            }
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