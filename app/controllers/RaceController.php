<?php

class RaceController extends BaseController {

    public static function races() {
        self::check_logged_in();
        $user = self::get_user_logged_in();

        $races = Race::all();

        View::make('/races/races.html', array('races' => $races, 'user' => $user));
    }
    
    public static function edit($id){
        $race = Race::find($id);
        $tracks = Track::all();
        $drivers = Driver::all();
        
        View::make('/races/race_edit.html', array('Race' => $race, 'tracks' => $tracks, 'drivers' => $drivers));
    }

    public static function store() {
        $params = $_POST;
        $user = $_SESSION['user'];

        $race = new Race(array(
            'name' => $params['name'],
            'year' => $params['year'],
            'track' => $params['track'],
            'winner' => $params['winner'],
            'user_id' => $user
        ));

        $errors = $race->errors();


        if (count($errors) > 0) {
            $tracks = Track::all();
            $drivers = Driver::all();
            View::make('races/race_create.html', array('errors' => $errors, 'tracks' => $tracks, 'drivers' => $drivers));
        } else {
            $race->save();
            Redirect::to('/races/' . $race->id, array('message' => 'Race added!'));
        }
    }
    
    public static function update($id) {
        $params = $_POST;
        
        
        $kisa = Race::find($id);
        $id = $kisa->id;
        
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'year' => $params['year'],
            'winner' => $params['winner'],
            'track' => $params['track']
        );
        
        
        $race = new Race($attributes);
        
        $errors = $race->errors();
        
        if(count($errors) > 0){
            View::make('/races/race_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $race->update();
            Redirect::to('/races/' . $race->id, array('message' => 'Race updated!'));
        }
        
    }

    public static function create() {
        $tracks = Track::all();
        $drivers = Driver::all();

        if(count($drivers) == 0){
            Redirect::to('/drivers', array('message' => 'You need at least one driver before creating a race'));
        } 

        if (count($tracks) == 0){
            Redirect::to('/tracks',  array('message' => 'You need at least one track before creating a race'));
        }

        View::make('races/race_create.html', array('tracks' => $tracks, 'drivers' => $drivers));
    }

    public static function destroy($id) {
        $race = new Race(array('id' => $id));
        $race->destroy();

        Redirect::to('/races', array('message' => 'Race Deleted!'));
    }

    public static function show($id) {
        $race = Race::find($id);
        $winner = Driver::find($race->winner);
        $track = Track::find($race->track);

        View::make('/show/race_page.html', array('Race' => $race, 'Winner' => $winner, 'Track' => $track));
    }

}

