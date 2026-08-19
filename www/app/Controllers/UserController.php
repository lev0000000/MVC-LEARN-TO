<?php

namespace App\Controllers;

use App\Models\User;
use PHPFramework\Pagination;

class UserController extends BaseController
{
    public function register()
    {

        echo view('user/register', [
            'title' => 'Register Page',
        ]);
    }

    public function store()
    {
        $model = new User();
        $model->loadData();
        if (!$model->validate()) {
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_DEFAULT);
            if ($id = $model->save()) {
                session()->setFlash('success', 'Thanks for registration. Your ID:' . $id);
                session()->setFlash('info', 'Info message');
            } else {
                session()->setFlash('error', 'Validation errors');
            }
        }

        response()->redirect('/register/');
        // dump($model->validate());
        // dump($model->getErrors());
        // dd($model->attributes);
    }

    public function login()
    {

        echo view('user/login', ['title' => 'Login Page']);
    }

    public function index()
    {

        $user_cnt = db()->query('select count(*) from users')->getColumn();

        $limit = PAGINATION_SETTINGS['perPage'];

        $pagination = new Pagination($user_cnt);

        dump($pagination);
        $users = db()->query("select * from users limit $limit offset {$pagination->getOffset()}")->get();

        echo view('user/index', [
            'title' => 'Users',
            'users' => $users,
            'pagination' => $pagination
        ]);
    }
}
