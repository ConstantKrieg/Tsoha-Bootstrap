<?php

 

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('frontpage/frontpage.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä 
      $kuskimies = new Driver(array(
        'num' => 'kjk',
        'name' => 'ak',
        'wins' => 101,
        'championships' => -3,
        'team_id' => 3
        ));

      $errors = $kuskimies->errors();

      Kint::dump($errors);

      //View::make('helloworld.html');
    }


  }
