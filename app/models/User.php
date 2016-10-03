<?php

class User extends BaseModel{


	public $id, $name, $password;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_name', 'validate_password');
	}

	public function authenticate(){
		$query = DB::connection()->prepare('SELECT * FROM Member WHERE name = :name AND password = :password LIMIT 1');
		$query->execute(array('name' => $name, 'password' => $password));
		$row = $query->fetch(); 

		if($row){
			$user = new User(array(
				'id' = $row['id'],
				'name' = $row['name'],
				'password' = $row['password']
				));

			return $user;
		} else {
			return null;
		}
	}


	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Member WHERE Member.id =:id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$user = new User(array(
				'id' = $row('id'),
				'name'= $row('name')
				'password' = $row('password');
				));
			return $user;
		}
		return null;

	}


}