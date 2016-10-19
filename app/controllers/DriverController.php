<?php

class DriverController extends BaseController {

    public static function index() {

        self::check_logged_in();
        $user = self::get_user_logged_in();
        
        
        $drivers = Driver:: all();
        View::make('drivers/drivers.html', array('drivers' => $drivers, 'user_logged_in' => $user));
    }

    public static function create() {
        $teams = Team::all();
        if(count($teams) == 0){
            Redirect::to('/teams', array('message' => 'You need to have at least one team before creating a driver'));
        }

        View::make('drivers/driver_create.html', array('teams' => $teams));
    }

    public static function show($id) {
        $driver = Driver::find($id);
        $team = Team::find($driver->team_id);

        View::make('/show/driver_page.html', array('Driver' => $driver, 'Team' => $team));
    }

    public static function edit($id) {
        $driver = Driver::find($id);
        View::make('/drivers/edit.html', array('Driver' => $driver));
    }

    


    public static function update($id) {
        $params = $_POST;
        
        
        $kuski = Driver::find($id);
        $id = $kuski->id;
        
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'wins' => $params['wins'],
            'championships' => $params['championships'],
            'num' => $params['num']
        );
        
        
        
        
        $driver = new Driver($attributes);


        $errors = $driver->errors();

        if (count($errors) > 0) {
            View::make('/drivers/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $driver->update();
            
            Redirect::to('/drivers/' . $driver->id , array('message' => 'Driver updated!'));
        }
   }

    


    public function destroy($id) {
        $driver = new Driver(array('id' => $id));

        $driver->destroy();
        Redirect::to('/drivers', array('message' => 'Driver deleted!'));
    }

    



    public static function store() {

        $params = $_POST;
        $user = $_SESSION['user'];




        $driver = new Driver(array(
            'num' => $params['num'],
            'team_id' => $params['team_id'],
            'name' => $params['name'],
            'wins' => $params['wins'],
            'championships' => $params['championships'],
            'user_id' => $user
        ));

        $errors = $driver->errors();

        if(count($errors) > 0){
            $teams = Team::all();
            View::make('drivers/driver_create.html', array('errors' => $errors, 'teams' => $teams));
        } else {
            $driver->save();

            Redirect::to('/drivers/' . $driver->id, array('message' => 'Driver added!'));
        }

        
    }

}
