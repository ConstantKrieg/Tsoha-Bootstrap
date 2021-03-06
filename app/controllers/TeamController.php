<?php

class TeamController extends BaseController {

    public static function teams() {
        self::check_logged_in();
        $user = self::get_user_logged_in();

        $teams = Team::all();

        View::make('/teams/teams.html', array('teams' => $teams, 'user' => $user));
    }
    
    public static function edit($id){
        $team = Team::find($id);
        View::make('/teams/team_edit.html', array('Team' => $team));
    }

    public static function store() {
        $params = $_POST;
        $user = $_SESSION['user'];

        $team = new Team(array(
            'name' => $params['name'],
            'wins' => $params['wins'],
            'championships' => $params['championships'],
            'user_id' => $user
        ));

        $errors = $team->errors();


        if (count($errors) > 0) {
            View::make('teams/create.html', array('errors' => $errors));
        } else {
            $team->save();
            Redirect::to('/teams/' . $team->id, array('message' => 'Team added!'));
        }
    }
    
    public static function update($id) {
        $params = $_POST;
        
        
        $tiimi = Team::find($id);
        $id = $tiimi->id;
        
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'wins' => $params['wins'],
            'championships' => $params['championships']
        );
        
        
        $team = new Team($attributes);
        
        $errors = $team->errors();
        
        if(count($errors) > 0){
            View::make('/teams/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $team->update();
            Redirect::to('/teams/' . $team->id, array('message' => 'Team updated!'));
        }
        
    }

    public static function create() {
        View::make('teams/create.html');
    }

    public static function destroy($id) {
        $team = new Team(array('id' => $id));
        $team->destroy();

        Redirect::to('/teams', array('message' => 'Team Deleted!'));
    }

    public static function show($id) {
        $team = Team::find($id);
        $drivers = Team::get_team_drivers($id);

        View::make('/show/team_page.html', array('Team' => $team, 'Drivers' => $drivers));
    }

}
