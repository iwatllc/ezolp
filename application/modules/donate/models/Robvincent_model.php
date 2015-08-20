<?php

class Robvincent_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
    }

    public function save($data)
    {

        $this->db->insert('robvincentform_submissions', $data);
        return $this->db->insert_id();

    }


}