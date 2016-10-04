<?php



/**
* 
*/

 class Driver extends BaseModel{
    
    public $id, $num, $name, $wins, $championships, $user_id;


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
                'id' => $row['id'],
                'num' => $row['num'],
                'name' => $row['name'],
                'wins' => $row['wins'],
                'championships' => $row['championships']
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
                'championships' => $row['championships']
                ));



            return $driver;
        }

        return null;
    }
    
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO DRIVER (num, name, wins, championships) VALUES (:num, :name, :wins, :championships) RETURNING id ');
        $query->execute(array('num' => $this->num,  'name' => $this->name, 'wins' =>  $this->wins, 'championships' => $this->championships));

        $row = $query->fetch();
        $this->id = $row['id'];
        
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
    

 }
