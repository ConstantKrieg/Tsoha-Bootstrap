<?php

class DriverController extends BaseController {

    public static function index() {

        $drivers = Driver:: all();
        View::make('drivers/drivers.html', array('drivers' => $drivers));
    }
    
    public static function create() {
        View::make('driver_create/driver_create.html');   
    }
    
    
    public static function show($num){
        $Driver = Driver::find($num);
        
        View::make('/show/driver_page.html', array('Driver' => $Driver));
    }
    
    
    public static function store(){
        
        $params = $_POST;
        
      
        
        $driver = new Driver(array(
            'num' => $params['num'],
            'team_id' => $params['team_id'],
            'name' => $params['name'],
            'wins' => $params['wins'],
            'championships' => $params['championships']
        ));
        
        
        
        $driver->save();
        
       // Redirect::to('/drivers/' . $game->id, array('message' => 'Driver added!'));
    }

}
