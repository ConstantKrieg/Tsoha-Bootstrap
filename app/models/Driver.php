<?php



/**
* 
*/

 class Driver extends BaseModel{
    
    public $id, $num, $name, $wins, $championships, $user_id, $team_id, $team_name;


    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_num', 'validate_wins', 'validate_championships');
    }


    public static function all(){

        $query = DB::connection()->prepare('SELECT * FROM Driver WHERE user_id = :user_id');
        $user = $_SESSION['user'];
        $query->execute(array('user_id' => $user));
        $rows = $query->fetchAll();
        $drivers = array();


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

    


    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Driver WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();


        if($row){
            $driver = new Driver(array(
                'id' => $row['id'],
                'num' => $row['num'],
                'name' => $row['name'],
                'wins' => $row['wins'],
                'championships' => $row['championships'],
                'team_id' => $row['team_id'],
                'user_id' => $row['user_id']
                ));



            return $driver;
        }

        return null;
    }
    
    
    public function save(){
        
        $query = DB::connection()->prepare('INSERT INTO DRIVER (num, name, wins, championships, team_id, user_id) VALUES (:num, :name, :wins, :championships, :team_id, :user_id) RETURNING id');
        $query->execute(array('num' => $this->num,  'name' => $this->name, 'wins' =>  $this->wins, 'championships' => $this->championships, 'team_id' => $this->team_id, 'user_id' =>$this->user_id));

        $row = $query->fetch();
        $this->id = $row['id'];

        self::set_team_name();
       
    }




    public function update(){
        $query = DB::connection()->prepare('UPDATE DRIVER SET name = :name, wins = :wins, championships = :championships  WHERE id = :id');
        $query->execute(array('id' => $this->id, 'name' => $this->name, 'wins' =>  $this->wins, 'championships' => $this->championships));
    }

    public function destroy(){
        $query = DB::connection()->prepare('DELETE From Driver WHERE Driver.id = :id');
        $query->execute(array('id' => $this->id));
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
    

    public function set_team_name(){
        $team_name_query = DB::connection()->prepare('SELECT name FROM Team WHERE id = :id');
        $team_name_query->execute(array('id' => $this->team_id));
        
        $row = $team_name_query->fetch();

        $team_name = $row['name'];

         $this->team_name = $team_name;
    }

 }
