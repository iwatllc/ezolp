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
                  $this->db->where('PaymentTransactionId', $search_array['PaymentTransactionId']);
              }
              
              if ($search_array['BegDate'] != NULL && $search_array['EndDate'] != NULL && $search_array['BegDate'] != "1969-12-31" && $search_array['EndDate'] != "1969-12-31")
              {
                    $this->db->where('DATE(InsertDate) >=', $search_array['BegDate'])->where('DATE(InsertDate) <=', $search_array['EndDate']);
                    
              } else if ($search_array['BegDate'] != NULL)
              {
                  $this->db->where('DATE(InsertDate) >=', $search_array['BegDate']);
                  
              } else if ($search_array['EndDate'] != NULL)
              {
                  $this->db->where('DATE(InsertDate) <=', $search_array['EndDate']);
              }
              
              if ($search_array['PaymentSource'] != NULL)
              {
                  $this->db->where('PaymentSource', $search_array['PaymentSource']);
              }
              
              if ($search_array['TransactionAmount'] != NULL)
              {
                  $this->db->where('TransactionAmount', $search_array['TransactionAmount']);
              }              
              
              if ($search_array['AuthCode'] != NULL)
              {
                  $this->db->where('AuthCode', $search_array['AuthCode']);
              }
              
              if ($search_array['OrderNumber'] != NULL)
              {
                  $this->db->where('OrderNumber', $search_array['OrderNumber']);
              }
              
              if ($search_array['CVV2ResponseMessage'] != NULL)
              {
                  $this->db->where('CVV2ResponseMessaaget', $search_array['CVV2ResponseMessage']);
              }
             
              if ($search_array['SerialNumber'] != NULL)
              {
                  $this->db->where('SerialNumber', $search_array['SerialNumber']);
              }
              
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
      
}