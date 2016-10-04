<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/drivers', function() {
  	DriverController::index();
  });

  $routes->get('/teams', function() {
  	HelloWorldController::team_list();
  });


  $routes->get('/teams/1', function() {
  	HelloWorldController::team_page();
  });

  
  $routes->get('/drivers/:id/edit', function($id){
    DriverController::edit($id);
  });

  $routes->post('/drivers/:id/edit', function($id){
    DriverController::update($id);
  });

   $routes->post('/drivers/:id/destroy', function($id){
    DriverController::destroy($id);
  });


  $routes->post('/drivers', function(){
      DriverController::store();
  });
  
  $routes->get('/drivers/new', function(){
      DriverController::create(); 
  });
    

  $routes->get('/drivers/:id', function($id) {
  	DriverController::show($id);
  });

  $routes->get('/teams/1/edit', function() {
  	HelloWorldController::team_edit();
  });


  $routes->get('/login', function() {
  	UserController::login();
  });

  $routes->post('/login', function(){
    UserController::handle_login();
  });


