<?php

class Ca_promo_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function list_all_promos($offset = 0, $row_count = 0)
    {
        if ($offset >= 0 AND $row_count > 0)
        {
            $query = $this -> db -> get('ca_promo', $row_count, $offset);
        }
        else
        {
            $query = $this->db->get('ca_promo');
        }

        return $query;
    }

    /**
     * Pass in the search array and query the database
     * Return the info from the database query
     */
    public function get_search_results($search_array)
    {
        // only search if search_array has something in it
        if (!empty($search_array))
        {
            $this->db->select('*');
            $this->db->from('payment_response');

            if ($search_array['PaymentTransactionId'] != NULL) {
                $this->db->where('payment_response.PaymentTransactionId', $search_array['PaymentTransactionId']);
            }

            if ($search_array['BegDate'] != NULL && $search_array['EndDate'] != NULL && $search_array['BegDate'] != "1969-12-31" && $search_array['EndDate'] != "1969-12-31") {
                $this->db->where('DATE(payment_response.InsertDate) >=', $search_array['BegDate'])->where('DATE(payment_response.InsertDate) <=', $search_array['EndDate']);
            } else if ($search_array['BegDate'] != NULL) {
                $this->db->where('DATE(payment_response.InsertDate) >=', $search_array['BegDate']);
            } else if ($search_array['EndDate'] != NULL) {
                $this->db->where('DATE(payment_response.InsertDate) <=', $search_array['EndDate']);
            }

            if ($search_array['PaymentSource'] != NULL) {
                $this->db->where('payment_response.PaymentSource', $search_array['PaymentSource']);
            }

            if ($search_array['TransactionAmount'] != NULL) {
                $this->db->where('payment_response.TransactionAmount', $search_array['TransactionAmount']);
            }

            if ($search_array['AuthCode'] != NULL) {
                $this->db->where('payment_response.AuthCode', $search_array['AuthCode']);
            }

            if ($search_array['OrderNumber'] != NULL) {
                $this->db->where('payment_response.OrderNumber', $search_array['OrderNumber']);
            }

            if ($search_array['CVV2ResponseCode'] != NULL) {
                $this->db->where('payment_response.CVV2ResponseCode', $search_array['CVV2ResponseCode']);
            }

            if ($search_array['SerialNumber'] != NULL) {
                $this->db->where('payment_response.SerialNumber', $search_array['SerialNumber']);
                $this->db->or_where('payment_response.TransactionFileName', $search_array['SerialNumber']);
            }

            if ($search_array['TransactionStatusId'] != NULL) {
                $this->db->where('payment_response.TransactionStatusId', $search_array['TransactionStatusId']);
            }

//              This is the old code that pulled the data from the tables using individual joins.  Changed to union.
//              $form_list = $this->_get_forms();
//              foreach ($form_list->result() as $form) {
//                  // $this->db->join($form->tablename, 'payment_response.PaymentTransactionId = '.$form->tablename.'.id and payment_response.PaymentSource = "'.$form->mnemonic.'" ', 'left');
//              }

            $this->db->join('form_submissions', 'payment_response.PaymentTransactionId = form_submissions.id and payment_response.PaymentSource = form_submissions.paymentsource ', 'left');

            $this->db->join('transaction_status', 'payment_response.TransactionStatusId = transaction_status.id', 'inner');

            $this->db->join('transaction_type', 'payment_response.TransactionTypeId = transaction_type.id', 'inner');

            $this->db->order_by('payment_response.InsertDate', 'DESC');

            // Sample of what the join should look like.
            //$this->db->join('virtualterminal_submissions', 'payment_response.PaymentTransactionId = virtualterminal_submissions.id and payment_response.PaymentSource = "VT" ');
            // Uncomment this to view the sql code in debug.
            // $sql = $this->db->get_compiled_select();

            return $this->db->get();

        } else {
            // search_array is empty
            return NULL;
        }

    }

    /**
     * Returns the amount of rows for a given query.
     */
    public function get_num_results($results)
    {
        return $results->num_rows();
    }

    /**
     * Returns the summation of TransactionAmount column.
     */
    public function get_total_amount($results)
    {
        $amt = 0;
        foreach ($results->result() as $result) {
            if($result->TransactionStatusId == 1) { //"Approved" add to Total
                $amt = $amt + $result->TransactionAmount;
            }
            else if($result->TransactionStatusId == 2) { //"Void" == 0
                $amt = $amt;
            }
            else if($result->TransactionStatusId == 3) { //"Refund" subtract from Total
                $amt = $amt - $result->TransactionAmount;
            }

        }
        return $amt;
    }

    private function _get_forms()
    {
        return $this->db->query('SELECT * FROM form_list');
    }

    public function get_transaction_statuses()
    {
        $query = $this->db->query('SELECT id, status FROM transaction_status WHERE active=1 ORDER BY id');
        $data = array();

        $data[''] = "-All-";
        foreach ($query->result() as $row) {
            $data[$row -> id] = $row -> status;
        }

        return $data;
    }

    public function get_form_lists()
    {
        $query = $this->db->query('SELECT mnemonic, name FROM form_list WHERE active=1 ORDER BY name');
        $data = array();

        $data[''] = "-All-";
        foreach ($query->result() as $row) {
            $data[$row -> mnemonic] = $row -> name;
        }

        return $data;
    }

}