<?php

class Track extends BaseModel {

    public $id, $name, $user_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_no_duplicates');
    }

    public static function all() {

       
        $query = DB::connection()->prepare('SELECT * FROM Track WHERE user_id = :user_id');
        $user = $_SESSION['user'];
        $query->execute(array('user_id' => $user));

        $rows = $query->fetchAll();
        $tracks = array();

        foreach ($rows as $row) {
            $tracks[] = new Track(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'user_id' => $row['user_id']
            ));
        }

        return $tracks;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Track WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();

        if ($row) {
            $track = new Track(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'user_id' => $row['user_id']
            ));
            return $track;
        }

        return null;
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Track (name, user_id) VALUES (:name, :user_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'user_id' => $this->user_id));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE From Track WHERE Track.id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_name() {
        $errors = array();
        $errors = parent::validate_string($this->name, 40);

        return $errors;
    }

    public function validate_no_duplicates() {
        $errors = array();
        $tracks = self::all();

        foreach ($tracks as $track) {
            $name = strtolower($track->getName());

            $tname = strtolower($this->name);
            $id = $track->getId();

            if ($name == $tname && $id != $this->id) {
                $errors[] = 'Track ' . $tname . ' already exists!';
            }
        }
        return $errors;
    }


    public function getName(){
        return $this->name;
    }

    public function getId(){
        return $this->id;
    }

}
