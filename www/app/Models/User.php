<?php

namespace App\Models;

use PHPFramework\Model;

class User extends Model{

  public $timestamps = false;

  protected $table = "users";

  protected $loaded = ['name','email','password','confirmPassword'];

  protected $fillable = ['name','email','password'];

  protected $rules = [
    'required' => ['name','email','password','confirmPassword'],
    'email' => ['email'],
    'lengthMin' => [
        ['password',6]
    ],
    'equals' => [
        ['password','confirmPassword']
    ]
];

protected $labels = [
    'name' => 'Имя',
    'email'=> 'Почта',
    'password'=> 'Пароль',
    'confirmPassword'=> 'Подтверждение пароля'
];

}