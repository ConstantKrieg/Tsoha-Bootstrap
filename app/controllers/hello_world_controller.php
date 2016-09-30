<?php

 

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('frontpage.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä 
      $kuskimies = new Driver(array(
        'num' => 30,
        'name' => 'ak',
        'wins' => 101,
        'championships' => -3,
        'team_id' => 3
        ));

      $errors = $kuskimies->errors();

      Kint::dump($errors);

      //View::make('helloworld.html');
    }


    public static function driver_list() {
      View::make('drivers_list.html');
    }

    public static function team_list(){
      View::make('team_list.html');
    }


    public static function driver_edit(){
      View::make('driver_edit.html');
    }

    public static function driver_page(){
      View::make('driver_page.html');
    }


    public static function team_edit(){
      View::make('team_edit.html');
    }

    public static function team_page(){
      View::make('team_page.html');
    }

    public static function login(){
      View::make('login.html');
    }
  }
