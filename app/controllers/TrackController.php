<?php

class TrackController extends BaseController {

    public static function tracks() {
        self::check_logged_in();
        $user = self::get_user_logged_in();

        $tracks = Track::all();

        View::make('/tracks/tracks.html', array('tracks' => $tracks, 'user' => $user));
    }

    public static function store() {

        $params = $_POST;
        $user = $_SESSION['user'];

        $track = new Track(array(
            'name' => $params['name'],
            'user_id' => $user
        ));
        
        $errors = $track->errors();
        
        if(count($errors) > 0){
            View::make('tracks/track_create.html', array('errors' => $errors));
        } else {
            $track->save();
            Redirect::to('/tracks', array('message' => 'Track created!'));
        }
    }
    
    public static function create() {
        View::make('tracks/track_create.html');
    }

}
