<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/drivers', function() {
  	HelloWorldController::driver_list();
  });

  $routes->get('/teams', function() {
  	HelloWorldController::team_list();
  });


  $routes->get('/teams/1', function() {
  	HelloWorldController::team_page();
  });

  $routes->get('/drivers/1', function() {
  	HelloWorldController::driver_page();
  });



  $routes->get('/drivers/1/edit', function() {
  	HelloWorldController::driver_edit();
  });

  $routes->get('/teams/1/edit', function() {
  	HelloWorldController::team_edit();
  });


  $routes->get('/login', function() {
  	HelloWorldController::login();
  });


