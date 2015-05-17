<?php

class Configsys_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
    }

    public function save_config_value($data)
    {

        $this->db->insert('virtualterminal_submissions', $data);
        return $this->db->insert_id();

    }

    public function get_config_value($data)
    {

        $query = $this->db->get_where('system_config', array('key' => $data));
        $row = $query->row();
        return $row->value;

    }




}