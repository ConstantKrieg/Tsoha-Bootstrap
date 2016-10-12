<?php


class Track extends BaseModel{
	

	public $id, $name, $user_id;


	public function __construct($attributes){
		parent::__construct($attributes);
	}



	public static function all($options){

		$query_string = 'SELECT * FROM Track WHERE user_id = :user_id';
		$options = array('user_id' => $options[$user_id]);

		if(isset($options['search'])){
			$query_string .= 'AND name LIKE :like';
			$options['like'] = '%' . $options['search'] . '%'; 
		}


		$query = DB::connection()->prepare($query_string);
		$query->execute($options);

		$rows = $query->fetchAll();
		$tracks = array();

		foreach ($rows as $row) {
			$tracks = new Track(array(
				'id' = $row['id'],
				'name' = $row['name'],
				'user_id' = $row['user_id']
				));
			}	

			return $tracks;
	}


	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Track WHERE id = :id' LIMIT 1);
		$query->execute(array('id' => $id));

		$row = $query->fetch();

		if($row){
			$track = new Track(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'user_id' => $row('user_id')
				));
			return $track;
		}

		return null;
	}

	public function save(){
        
        $query = DB::connection()->prepare('INSERT INTO Track (name, user_id) VALUES (:name, :user_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'user_id' =>$this->user_id));

        $row = $query->fetch();
        $this->id = $row['id'];
    }


     public function destroy(){
        $query = DB::connection()->prepare('DELETE From Track WHERE Track.id = :id');
        $query->execute(array('id' => $this->id));
    }
}