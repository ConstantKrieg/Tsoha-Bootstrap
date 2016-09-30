<?php



/**
* 
*/

 class Driver extends BaseModel{
    
    public $num, $name, $wins, $championships, $team_id;


    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_num', 'validate_wins', 'validate_championships');
    }


    public static function all(){

        $query = DB::connection()->prepare('SELECT * FROM Driver');

        $query->execute();

        $rows = $query->fetchAll();
        $drivers = array();


        foreach ($rows as $row) {
            $drivers[] = new Driver(array(
                'num' => $row['num'],
                'name' => $row['name'],
                'wins' => $row['wins'],
                'championships' => $row['championships'],
                'team_id' => $row['team_id']
            ));
        }

        return $drivers;
    }


    public static function find($num){
        $query = DB::connection()->prepare('SELECT * FROM Driver WHERE num = :num LIMIT 1');
        $query->execute(array('num' => $num));
        $row = $query->fetch();


        if($row){
            $driver = new Driver(array(
                'num' => $row['num'],
                'name' => $row['name'],
                'wins' => $row['wins'],
                'championships' => $row['championships'],
                'team_id' => $row['team_id']
                ));



            return $driver;
        }

        return null;
    }
    
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO DRIVER (num, team_id, name, wins, championships) VALUES (:num, :team_id, :name, :wins, :championships)');
        $query->execute(array('num' => $this->num, 'team_id' => $this->team_id, 'name' => $this->name, 'wins' =>  $this->wins, 'championships' => $this->championships));
        
    }




    public function validate_name(){
        $errors = array();
        $errors = parent::validate_string($this->name, 40);

        return $errors;
    }

    public function validate_num(){
        $errors = array();
        $errors = parent::validate_number($this->num, 99);

        return $errors;
    }

    public function validate_wins(){
        $errors = array();
        $errors = parent::validate_number($this->wins, 99);

        return $errors;
    }

    public function validate_championships(){
        $errors = array();
        $errors = parent::validate_number($this->championships, 99);

        return $errors;
    }
    

 }
