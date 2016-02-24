<?php

class Classifiedad_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
    }

    public function add_classifiedad_submission($data)
    {
        $this -> db -> insert('classifiedad_submissions', $data);

        return $this -> db -> insert_id();
    }


}