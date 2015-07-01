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
              
              if ($search_array['PaymentSource'] != NULL)
              {
                  $this->db->where('PaymentSource', $search_array['PaymentSource']);
              }
              
              if ($search_array['AuthCode'] != NULL)
              {
                  $this->db->where('AuthCode', $search_array['AuthCode']);
              }
              
              if ($search_array['TransactionAmount'] != NULL)
              {
                  $this->db->where('TransactionAmount', $search_array['TransactionAmount']);
              }
              
              return $this->db->get();
              
          }else // search_array is empty
          {
              return NULL;
          }
          
      }
      
}