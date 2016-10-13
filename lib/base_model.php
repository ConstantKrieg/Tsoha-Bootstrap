<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {

            $method_name = $validator;
            $validator_errors = array();
            $validator_errors = $this->{$method_name}();

            $errors = array_merge($errors, $validator_errors);
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        }

        return $errors;
    }

    public function validate_string($string, $length) {
        $errors = array();

        if ($string == '' || $string == null) {
            $errors[] = 'Name cannot be empty!';
        }

        if (strlen($string) < 3 || strlen($string) > $length) {
            $errors[] = 'Name has to be at least three characters and cannot be over 100 characters!';
        }
        return $errors;
    }

    public function validate_number($number, $max) {
        $errors = array();


        if (!is_numeric($number)) {
            $errors[] = 'A number is required!';
        }


        return $errors;
    }

}
