<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      }

      return $errors;
    }
    
    public function validate_string(){
        $errors = array();
        
        if($this->name == '' || $this->name == null){
            $errors[] = 'Name cannot be empty!';
        }
        
        if(strlen($this->name) <  3 || strlen($string) > 99){
            $errors[] = 'Name has to be at least three characters and cannot be over 100 characters!';
        }
        return $errors;
    }
    
    
    public function validate_number(){
        $errors = array();
        
        if($this->num > 99 || $this->num < 1 || $this->num == null){
            $errors[] = 'Number has to be between 1 and 99!';
        }
        
        if(!is_numeric($this->num)){
            $errors[] = 'A number is required!';
        }
        
        return errors;
    }
    
  
        
        
    

  }
