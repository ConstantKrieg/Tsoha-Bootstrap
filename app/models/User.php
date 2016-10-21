<?php

class User extends BaseModel {

    public $id, $name, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_password', 'validate_no_duplicates');
    }

    public function authenticate($name, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Member WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));

            return $user;
        } else {
            return null;
        }
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Member');
        $query->execute();
        $rows = $query->fetchAll();
        $users = array();

        foreach ($rows as $row) {
            $users[] = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
                ));
        }
        return $users;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Member WHERE Member.id =:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $user;
        }
        return null;
    }


    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Member (name, password) VALUES (:name, :password) RETURNING id');
        $query->execute(array('name' => $this->name, 'password' => $this->password));

        $row = $query->fetch();
        $this->id = $row['id'];

    }


    public function validate_name(){
        $errors = array();
        $errors = parent::validate_string($this->name, 25);

        return $errors;
    }


    public function validate_password(){
        $errors = array();
        $errors = parent::validate_string($this->name, 18);

        return $errors;
    }

    public function getName(){
        return $this->name;
    }

    public function getId(){
        return $this->id;
    }


    public function validate_no_duplicates() {
        $errors = array();
        $users = self::all();

        foreach ($users as $user) {
            $name = strtolower($user->getName());

            $tname = strtolower($this->name);
            $id = $user->getId();

            if ($name == $tname && $id != $this->id) {
                $errors[] = 'User ' . $tname . ' already exists!';
            }
        }
        return $errors;
    }

}
