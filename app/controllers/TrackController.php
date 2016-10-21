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
    
    public static function edit($id){
       
        $track = Track::find($id);
        View::make('/tracks/track_edit.html', array('Track' => $track));
    }
    
    public static function update($id) {
        $params = $_POST;
        
        
        $rata = Track::find($id);
        $id = $rata->id;
        
        $attributes = array(
            'id' => $id,
            'name' => $params['name']
        );
        
        
        $track = new Track($attributes);
        
        $errors = $track->errors();
        
        if(count($errors) > 0){
            View::make('/track/track_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $track->update();
            Redirect::to('/tracks/' . $track->id , array('message' => 'Track updated!'));
        }
        
    }
    
    
    public static function create() {
        View::make('tracks/track_create.html');
    }
    
    
    public static function show($id) {
        $track = Track::find($id);
        
        View::make('/show/track_page.html', array('Track' => $track));
        
    }
    
    
    public static function destroy($id){
        $track = new Track(array('id' => $id));
        $track->destroy();
        
        Redirect::to('/tracks', array('message' => 'Track deleted'));
    }

}
