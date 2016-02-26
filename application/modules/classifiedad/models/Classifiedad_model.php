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

    function check_promo_code($code)
    {
        $this -> db -> where('code',$code);
        $query = $this -> db -> get('ca_promo');
        if ($query -> num_rows() > 0)
        {
            return $query -> row();
        }
        else
        {
            return '';
        }
    }

}