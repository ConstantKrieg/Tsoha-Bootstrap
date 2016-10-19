<?php

class Race extends BaseModel {

    public $id, $name, $year, $track, $winner, $user_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_year');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Race WHERE user_id = :user_id');
        $user = $_SESSION['user'];
        $query->execute(array('user_id' => $user));
        $rows = $query->fetchAll();
        $races = array();

        foreach ($rows as $row) {
            $races[] = new Race(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'year' => $row['year'],
                'track' => $row['track'],
                'winner' => $row['winner'],
                'user_id' => $row['user_id']
            ));
        }

        return $races;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Race WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $race = new Race(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'year' => $row['year'],
                'track' => $row['track'],
                'winner' => $row['winner'],
                'user_id' => $row['user_id']
            ));
            return $race;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Race(name, year, track, winner, user_id) VALUES (:name, :year, :track, :winner, :user_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'year' => $this->year, 'track' => $this->track, 'winner' => $this->winner,'user_id' => $this->user_id));

        $row = $query->fetch();
        $this->id = $row['id'];
        
        
    }
    
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE From Race WHERE Race.id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_name(){
        $errors = array();
        $errors = parent::validate_string($this->name, 30);

        return $errors;
    }

    public function validate_year(){
        $errors = array();
        $errors = parent::validate_number($this->year, 3000);

        return $errors;
    }

}
