<?php



/**
* 
*/

 class Driver extends BaseModel{
    
    public $num, $name, $wins, $championships, $team_id;


    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_number');
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
    

 }
