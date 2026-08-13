<?php

namespace PHPFramework;

use Valitron\Validator;

abstract class Model extends \Illuminate\Database\Eloquent\Model {

    protected $fillable = [];

    public $attributes = [];

    protected $rules = [];

    protected $labels = [];

    protected $error = [];


    public function save (array $options = []) {
      foreach($this->attributes as $key => $value ) {
        if(!in_array($key,$this->fillable)) {
          unset($this->attributes[$key]);    
        }
      }
      return parent::save();
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