<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});



$routes->get('/teams', function() {
    TeamController::teams();
});

$routes->get('/tracks', function() {
    TrackController::tracks();
});







$routes->get('/drivers/:id/edit', function($id) {
    DriverController::edit($id);
});

$routes->post('/drivers/:id/edit', function($id) {
    DriverController::update($id);
});

$routes->get('/drivers', function() {
    DriverController::index();
});


$routes->get('/teams/:id/edit', function($id) {
    TeamController::edit($id);
});

$routes->post('/teams/:id/edit', function($id){
    TeamController::update($id); 
});











$routes->post('/drivers/:id/destroy', function($id) {
    DriverController::destroy($id);
});

$routes->post('/teams/:id/destroy', function($id) {
    TeamController::destroy($id);
});


$routes->post('/drivers', function() {
    DriverController::store();
});

$routes->post('/teams', function() {
    TeamController::store();
});

$routes->post('/tracks', function() {
    TrackController::store();
});





$routes->get('/drivers/new', function() {
    DriverController::create();
});

$routes->get('/teams/new', function() {
    TeamController::create();
});

$routes->get('/tracks/new', function() {
    TrackController::create();
});





$routes->get('/drivers/:id', function($id) {
    DriverController::show($id);
});

$routes->get('/teams/:id', function($id) {
    TeamController::show($id);
});

$routes->get('/tracks/:id', function($id) {
    TrackController::show($id);
});







$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});


$routes->post('/logout', function() {
    UserController::logout();
});


