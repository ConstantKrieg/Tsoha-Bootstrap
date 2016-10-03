<?php

class DriverController extends BaseController {

    public static function index() {

        $drivers = Driver:: all();
        View::make('drivers/drivers.html', array('drivers' => $drivers));
    }
    
    public static function create() {
        View::make('drivers/driver_create.html');   
    }
    
    
    public static function show($id){
        $driver = Driver::find($id);
        
        View::make('/show/driver_page.html', array('Driver' => $driver));
    }



    public static function edit($id){
        $driver = Driver::find($id);
        View::make('/drivers/edit.html', array('Driver' => $driver));
    }


    public static function update($id){
        $params = $_POST;


         $driver = new Driver (array(
            'num' => $params['num'],
            'name' => $params['name'],
            'wins' => $params['wins'],
            'championships' => $params['championships']
        ));


        $errors = $driver->errors();

        if(count($errors) > 0){
            View::make('/drivers/edit.html', array('errors' => $errors, 'attributes' => $attributes));
            Kint::dump($errors);
        } else {
            $driver->update();
            Redirect::to('/drivers' . $driver->id, array('message' => 'Driver updated!'));
        }


    }
    

    public function destroy($id){
        $driver = new Driver(array('id' => $id));

        $driver->destroy();
        Redirect::to('/drivers', array('message' => 'Driver deleted!'));
    }
    
    public static function store(){
        
        $params = $_POST;
        
      
        
        $driver = new Driver(array(
            'num' => $params['num'],
            'name' => $params['name'],
            'wins' => $params['wins'],
            'championships' => $params['championships']
        ));
        
        
        
        $driver->save();
        
        Redirect::to('/drivers/' . $driver->id, array('message' => 'Driver added!'));
    }

}
