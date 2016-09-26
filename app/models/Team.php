<?php


	class Team extends BaseModel{

		public $id, $name, $wins, $championships;



		public function __construct($attributes){
			parent::__construct($attributes);
		}


		public static function all(){

        	$query = DB::connection()->prepare('SELECT * FROM Team');

        	$query->execute();

        	$rows = $query->fetchAll();
        	$teams = array();


        	foreach ($rows as $row) {
            	$teams[] = new Team(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'wins' => $row['wins'],
                'championships' => $row['championships'],
            	));
       	}

        	return $teams;
    	}

	}