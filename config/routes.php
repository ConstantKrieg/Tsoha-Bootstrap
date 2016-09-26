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

  


  $routes->post('/drivers', function(){
      DriverController::store();
  });
  
  $routes->get('/drivers/new', function(){
      DriverController::create(); 
  });
    

  $routes->get('/drivers/:id', function($num) {
  	DriverController::show($num);
  });

  $routes->get('/teams/1/edit', function() {
  	HelloWorldController::team_edit();
  });


  $routes->get('/login', function() {
  	HelloWorldController::login();
  });


