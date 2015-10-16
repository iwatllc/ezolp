<?php

class Lookup_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Pass in the unique_id and query the database for the person's info
     * Return query from database
     */
    public function search($unique_id)
    {
        $this->db->select('*');
        $this->db->from('virtualterminal_submissions');
        $this->db->where('id', $unique_id);

        $query = $this->db->get();

        return $query;
    }
}