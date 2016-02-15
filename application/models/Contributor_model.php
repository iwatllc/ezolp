<?php

class Contributor_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
    }

    public function insert($data)
    {
        $this->db->insert('contributors', $data);
        return $this->db->insert_id();
    }


}