<?php

class Team extends BaseModel {

    public $id, $name, $wins, $championships, $user_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_wins', 'validate_championships');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Team WHERE  Team.user_id = :user');
        $user = $_SESSION['user'];
        $query->execute(array('user' => $user));



        $rows = $query->fetchAll();
        $teams = array();


        foreach ($rows as $row) {
            $teams[] = new Team(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'wins' => $row['wins'],
                'championships' => $row['championships'],
                'user_id' => $row['user_id']
            ));
        }

        return $teams;
    }




    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Team WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $team = new Team(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'wins' => $row['wins'],
                'championships' => $row['championships'],
                'user_id' => $row['user_id']
            ));
            return $team;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Team(name, wins, championships, user_id) VALUES (:name, :wins, :championships, :user_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'wins' => $this->wins, 'championships' => $this->championships, 'user_id' => $this->user_id));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $dquery = DB::connection()->prepare('DELETE FROM Driver WHERE Driver.team_id= :id');
        $dquery->execute(array('id' => $this->id));

        $query = DB::connection()->prepare('DELETE FROM Team WHERE Team.id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Team SET name = :name, wins = :wins, championships = :championships  WHERE id = :id');
        $query->execute(array('id' => $this->id, 'name' => $this->name, 'wins' =>  $this->wins, 'championships' => $this->championships));
    }

    public function validate_name() {
        $errors = array();
        $errors = parent::validate_string($this->name, 40);

        return $errors;
    }

    public function validate_wins() {
        $errors = array();
        $errors = parent::validate_number($this->wins, 99);

        return $errors;
    }

    public function validate_championships() {
        $errors = array();
        $errors = parent::validate_number($this->championships, 99);

        return $errors;
    }


    public static function get_team_drivers($id){
        $drivers = array();
        $user = $_SESSION['user'];

        $query = DB::connection()->prepare('SELECT * FROM Driver WHERE Driver.team_id = :id AND Driver.user_id = :uid');
        $query->execute(array('id' => $id, 'uid' => $user));
        $rows = $query->fetchAll();

        foreach ($rows as $row) {
            $drivers[] = new Driver(array(
                'id' => $row['id'],
                'num' => $row['num'],
                'name' => $row['name'],
                'wins' => $row['wins'],
                'championships' => $row['championships'],
                'team_id' => $row['team_id'],
                'user_id' => $row['user_id']
                ));
        }
        return $drivers;
    }

}
