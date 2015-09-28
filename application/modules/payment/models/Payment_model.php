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

	public function get($data) {
		$this->db->from('payment_response');
		$this->db->where($data);
		
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
		    log_message("DEBUG", "getByTransactionIdReturns -> ".$row->TransactionAmount);
			return $row;
		}
	}
}