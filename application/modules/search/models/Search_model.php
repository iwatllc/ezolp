<?php

class Search_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
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
              
              if ($search_array['PaymentTransactionId'] != NULL)
              {
                  $this->db->where('payment_response.PaymentTransactionId', $search_array['PaymentTransactionId']);
              }
              
              if ($search_array['BegDate'] != NULL && $search_array['EndDate'] != NULL && $search_array['BegDate'] != "1969-12-31" && $search_array['EndDate'] != "1969-12-31")
              {
                    $this->db->where('DATE(payment_response.InsertDate) >=', $search_array['BegDate'])->where('DATE(payment_response.InsertDate) <=', $search_array['EndDate']);
                    
              } else if ($search_array['BegDate'] != NULL)
              {
                  $this->db->where('DATE(payment_response.InsertDate) >=', $search_array['BegDate']);
                  
              } else if ($search_array['EndDate'] != NULL)
              {
                  $this->db->where('DATE(payment_response.InsertDate) <=', $search_array['EndDate']);
              }
              
              if ($search_array['PaymentSource'] != NULL)
              {
                  $this->db->where('payment_response.PaymentSource', $search_array['PaymentSource']);
              }
              
              if ($search_array['TransactionAmount'] != NULL)
              {
                  $this->db->where('payment_response.TransactionAmount', $search_array['TransactionAmount']);
              }              
              
              if ($search_array['AuthCode'] != NULL)
              {
                  $this->db->where('payment_response.AuthCode', $search_array['AuthCode']);
              }
              
              if ($search_array['OrderNumber'] != NULL)
              {
                  $this->db->where('payment_response.OrderNumber', $search_array['OrderNumber']);
              }
              
              if ($search_array['CVV2ResponseMessage'] != NULL)
              {
                  $this->db->where('payment_response.CVV2ResponseMessaaget', $search_array['CVV2ResponseMessage']);
              }
             
              if ($search_array['SerialNumber'] != NULL)
              {
                  $this->db->where('payment_response.SerialNumber', $search_array['SerialNumber']);
              }

              $form_list = $this->_get_forms();

              foreach ($form_list->result() as $form) {
                  $this->db->join($form->tablename, 'payment_response.PaymentTransactionId = '.$form->tablename.'.id and payment_response.PaymentSource = "'.$form->mnemonic.'" ', 'left');
              }

              // Sample of what the join should look like.
              //$this->db->join('virtualterminal_submissions', 'payment_response.PaymentTransactionId = virtualterminal_submissions.id and payment_response.PaymentSource = "VT" ');
              // Uncomment this to view the sql code in debug.
              // $sql = $this->db->get_compiled_select();

              return $this->db->get();
              
          } else // search_array is empty
          {
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
    public function get_total_amount($amount)
    {
        $this->db->select('SUM(TransactionAmount) as amt');
        $this->db->from('payment_response');
        $this->db->where('TransactionAmount', $amount);
        $q = $this->db->get();
        $row = $q->row();
        
        return $row->amt;
    }

    private function _get_forms()
    {
        return $this->db->query('SELECT * FROM form_list');
    }
      
}