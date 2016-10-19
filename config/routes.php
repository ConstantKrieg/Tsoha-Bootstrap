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

$routes->get('/races', function(){
    RaceController::races();
});

$routes->get('/drivers', function() {
    DriverController::index();
});







$routes->get('/drivers/:id/edit', function($id) {
    DriverController::edit($id);
});

$routes->post('/drivers/:id/edit', function($id) {
    DriverController::update($id);
});


$routes->get('/races/:id/edit', function($id){
    RaceController::edit($id);
});

$routes->post('/races/:id/edit', function($id) {
    RaceController::update($id);
});


$routes->get('/tracks/:id/edit', function($id){
    TrackController::edit($id);
});

$routes->post('/tracks/:id/edit', function($id) {
    TrackController::update($id);
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

$routes->post('/tracks/:id/destroy', function($id) {
    TrackController::destroy($id);
});

$routes->post('/races/:id/destroy', function($id) {
    RaceController::destroy($id);
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

$routes->post('/races', function() {
    RaceController::store();
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

$routes->get('/races/new', function() {
    RaceController::create();
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

$routes->get('/races/:id', function($id) {
    RaceController::show($id);
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


