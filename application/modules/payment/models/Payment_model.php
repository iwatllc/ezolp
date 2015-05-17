<?php
/**
 * Created by PhpStorm.
 * User: robertfulcher
 * Date: 4/16/15
 * Time: 12:20 AM
 */

class Payment_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {

        $this->db->insert('payment_response', $data);
        return $this->db->insert_id();

    }

    public function update($data, $id)
    {
        $this->db->where('PaymentResponseId', $id);
        $this->db->update('payment_response', $data);
    }


}