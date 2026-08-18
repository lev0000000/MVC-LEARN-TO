<?php

namespace PHPFramework;

use Valitron\Validator;

abstract class Model {

    protected string $table;

    protected bool $timestamps = false;
    protected array $fillable = [];

    public array $attributes = [];

    protected array $rules = [];

    protected array $labels = [];

    protected array $error = [];

    protected array $loaded = [];


    public function save (array $options = []) {
      foreach($this->attributes as $key => $value ) {
        if(!in_array($key,$this->fillable)) {
          unset($this->attributes[$key]);    
        }
      }

      

      $fields_keys = array_keys($this->attributes);
      
      $fields = array_map(fn($field) => "`{$field}`", $fields_keys);

      $fields = implode(',', $fields);

      if($this->timestamps){
        $fields .= ',`created_at`,`updated_at`';
      }

      $placeholders = array_map(fn($value) => ":{$value}", $fields_keys);

      $placeholders = implode(',', $placeholders);

      if($this->timestamps){
        $placeholders .= ', :created_at, :updated_at';
        $this->attributes['created_at'] = date('Y-m-d H:i:s');
        $this->attributes['updated_at'] = date('Y-m-d H:i:s');
      }

      $query = 'insert into ' . $this->table . ' (' . $fields . ') values (' . $placeholders . ')';

      db()->query($query, $this->attributes);

      return db()->getInsertId();

    }

    public function loadData () :void {
        $data = request()->getData();
        foreach($this->loaded as $field) {
            if(isset($data[$field])) {
                $this->attributes[$field] = $data[$field];
            }else {
                $this->attributes[$field] = '';
            }
        }
    }

    public function validate ($data=[], $rules = [], $labels = []) :bool {
      if(!$data){
        $data = $this->attributes;
      }

      if(!$rules){
        $rules = $this->rules;
      }

      if(!$labels){
        $labels = $this->labels;
      }

      Validator::addRule('unique', function($field, $value, array $params, array $fields){
        $data = explode(',',$params[0]);
        return !($user = db()->findOne($data[0], $value, $data[1]));
      }, 'Everything you do is wrong. You fail.');

      Validator::langDir(WWW . '/lang');
      Validator::lang('ru');
      $validator = new Validator( $data );
      $validator->rules($rules);
      $validator->labels($labels);
      if($validator->validate()){
        return true;
      } else {
        $this->error = $validator->errors();
        return false;
      }
    }

    public function getErrors () :array {

        return $this->error;
    }


}